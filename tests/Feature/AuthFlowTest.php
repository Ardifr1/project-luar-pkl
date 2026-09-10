<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

/*
|--------------------------------------------------------------------------
| AUTH FLOW TEST
|--------------------------------------------------------------------------
|
| Menguji 10 skenario verifikasi authentication/session:
|  1. Login guru normal
|  2. Login admin normal
|  3. Guru membuka /dashboard
|  4. Admin membuka /dashboardadmin
|  5. Guest membuka /dashboard  -> redirect /login
|  6. Guest membuka /dashboardadmin -> redirect /login
|  7. Guru membuka halaman admin -> 403
|  8. Akun yang login di device lain tidak bisa login
|  9. Session device lama yang expired TIDAK memblokir login baru
| 10. Tidak ada redirect loop ke /login
|
| Catatan: tabel yang dibutuhkan dibuat manual (bukan RefreshDatabase)
| karena beberapa migration project menggunakan sintaks MySQL-only
| (ALTER TABLE ... MODIFY) yang tidak jalan di sqlite testing.
| Test ini tidak menyentuh database produksi.
|
*/

class AuthFlowTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        /*
        | PENGAMAN KERAS: test ini membuat/menghapus tabel via Schema.
        | Jangan pernah dijalankan terhadap database produksi (MySQL).
        | Jika koneksi bukan sqlite :memory:, gagalkan test sebelum
        | perintah DDL manapun dieksekusi.
        |
        | (Latar belakang: env DB_CONNECTION=mysql dari OS dapat menimpa
        | <env> phpunit yang tidak ber-attribute force="true".)
        */

        if (config('database.default') !== 'sqlite') {
            self::fail(
                'KEAMANAN: test ini hanya boleh jalan di sqlite :memory:. ' .
                'Koneksi aktif: ' . config('database.default') .
                ' (' . DB::connection()->getDatabaseName() . '). ' .
                'Pastikan phpunit.xml memakai force="true" untuk DB_CONNECTION.'
            );
        }

        // Tabel user (struktur sama dengan migration create_user_table)
        Schema::dropIfExists('user');
        Schema::create('user', function ($table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('username')->nullable()->unique();
            $table->string('nip')->nullable()->unique();
            $table->string('password');
            $table->enum('role', ['admin', 'guru'])->default('guru');
            $table->timestamps();
        });

        // Tabel sessions (dibutuhkan driver database + fitur 1 akun 1 device)
        Schema::dropIfExists('sessions');
        Schema::create('sessions', function ($table) {
            $table->string('id')->primary();
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        // Tabel personal_access_tokens (dibutuhkan createToken Sanctum saat login)
        Schema::dropIfExists('personal_access_tokens');
        Schema::create('personal_access_tokens', function ($table) {
            $table->id();
            $table->morphs('tokenable');
            $table->string('name');
            $table->string('token', 64)->unique();
            $table->text('abilities')->nullable();
            $table->timestamp('last_used_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
        });
    }

    protected function tearDown(): void
    {
        /*
        | PENGAMAN: pembersihan tabel hanya dilakukan di sqlite.
        | Tidak pernah menjalankan DROP TABLE terhadap MySQL/produksi
        | walau setUp gagal di tengah jalan.
        */

        if (config('database.default') === 'sqlite') {
            Schema::dropIfExists('personal_access_tokens');
            Schema::dropIfExists('sessions');
            Schema::dropIfExists('user');
        }

        parent::tearDown();
    }

    // =========================
    // FACTORY SEDERHANA
    // =========================

    private function buatGuru(array $attr = []): User
    {
        return User::create(array_merge([
            'name' => 'Guru Test',
            'username' => null,
            'nip' => '1234567890',
            'password' => Hash::make('password123'),
            'role' => 'guru',
        ], $attr));
    }

    private function buatAdmin(array $attr = []): User
    {
        return User::create(array_merge([
            'name' => 'Admin Test',
            'username' => 'admin01',
            'nip' => null,
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ], $attr));
    }

    // =========================
    // 1. LOGIN GURU NORMAL
    // =========================

    public function test_1_login_guru_normal_masuk_dashboard(): void
    {
        $this->buatGuru();

        $response = $this->post('/login', [
            'login' => '1234567890',
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertAuthenticated();
    }

    // =========================
    // 2. LOGIN ADMIN NORMAL
    // =========================

    public function test_2_login_admin_normal_masuk_dashboardadmin(): void
    {
        $this->buatAdmin();

        $response = $this->post('/login', [
            'login' => 'admin01',
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('dashboardadmin'));
        $this->assertAuthenticated();
    }

    // =========================
    // 3. GURU MEMBUKA /DASHBOARD
    // =========================

    public function test_3_guru_login_membuka_dashboard_tanpa_redirect_login(): void
    {
        $guru = $this->buatGuru();

        $response = $this->actingAs($guru)->get('/dashboard');

        $response->assertOk();
        $this->assertAuthenticatedAs($guru);
    }

    // =========================
    // 4. ADMIN MEMBUKA /DASHBOARDADMIN
    // =========================

    public function test_4_admin_login_membuka_dashboardadmin_tanpa_redirect_login(): void
    {
        $admin = $this->buatAdmin();

        $response = $this->actingAs($admin)->get('/dashboardadmin');

        $response->assertOk();
        $this->assertAuthenticatedAs($admin);
    }

    // =========================
    // 5. GUEST MEMBUKA /DASHBOARD
    // =========================

    public function test_5_guest_diarahkan_ke_login_saat_buka_dashboard(): void
    {
        $response = $this->get('/dashboard');

        $response->assertRedirect(route('login'));
        $this->assertGuest();
    }

    // =========================
    // 6. GUEST MEMBUKA HALAMAN ADMIN
    // =========================

    public function test_6_guest_diarahkan_ke_login_saat_buka_halaman_admin(): void
    {
        $response = $this->get('/dashboardadmin');

        $response->assertRedirect(route('login'));
        $this->assertGuest();
    }

    // =========================
    // 7. GURU MEMBUKA HALAMAN ADMIN
    // =========================

    public function test_7_guru_ditolak_403_saat_buka_halaman_admin(): void
    {
        $guru = $this->buatGuru();

        $response = $this->actingAs($guru)->get('/dashboardadmin');

        $response->assertForbidden();
        $this->assertAuthenticatedAs($guru);
    }

    // =========================
    // 8. AKUN LOGIN DI DEVICE LAIN
    // =========================

    public function test_8_akun_yang_sedang_login_di_device_lain_ditolak(): void
    {
        $guru = $this->buatGuru();

        // Simulasikan session aktif di device lain (session id berbeda,
        // last_activity masih segar / belum expired).
        DB::table('sessions')->insert([
            'id' => 'session-device-lain-0000000000000000000000000000',
            'user_id' => $guru->id,
            'ip_address' => '127.0.0.1',
            'user_agent' => 'other-device',
            'payload' => base64_encode('test'),
            'last_activity' => now()->timestamp,
        ]);

        $response = $this->post('/login', [
            'login' => '1234567890',
            'password' => 'password123',
        ]);

        $response->assertSessionHasErrors('login');
        $this->assertGuest();
    }

    // =========================
    // 9. SESSION EXPIRED TIDAK MEMBLOKIR LOGIN BARU
    // =========================

    public function test_9_session_lama_yang_expired_tidak_memblokir_login(): void
    {
        $guru = $this->buatGuru();

        $lifetime = (int) config('session.lifetime', 120);

        // Simulasikan session device lama yang SUDAH MELEWATI lifetime.
        DB::table('sessions')->insert([
            'id' => 'session-expired-000000000000000000000000000000',
            'user_id' => $guru->id,
            'ip_address' => '127.0.0.1',
            'user_agent' => 'old-device',
            'payload' => base64_encode('test'),
            'last_activity' => now()->subMinutes($lifetime + 10)->timestamp,
        ]);

        $response = $this->post('/login', [
            'login' => '1234567890',
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertAuthenticated();

        // Session expired harus sudah dihapus oleh proses login.
        $this->assertDatabaseMissing('sessions', [
            'id' => 'session-expired-000000000000000000000000000000',
        ]);
    }

    // =========================
    // 10. TIDAK ADA REDIRECT LOOP
    // =========================

    public function test_10a_guest_root_diarahkan_sekali_ke_login_dan_login_tampil(): void
    {
        // GET / (guest) -> redirect ke /login
        $this->get('/')->assertRedirect(route('login'));

        // GET /login harus menampilkan form (200) -> tidak ada loop.
        $this->get('/login')->assertOk();
    }

    public function test_10b_guru_sudah_login_tidak_dilempar_balik_ke_login(): void
    {
        $guru = $this->buatGuru();

        // GET / (sudah login) -> langsung dashboard, BUKAN /login.
        $this->actingAs($guru)->get('/')->assertRedirect(route('dashboard'));

        // GET /login (sudah login) -> diarahkan ke dashboard, BUKAN form login.
        $this->actingAs($guru)->get('/login')->assertRedirect(route('dashboard'));
    }

    public function test_10c_admin_sudah_login_tidak_dilempar_balik_ke_login(): void
    {
        $admin = $this->buatAdmin();

        // GET / (sudah login) -> langsung dashboardadmin.
        $this->actingAs($admin)->get('/')->assertRedirect(route('dashboardadmin'));

        // GET /login (sudah login) -> diarahkan ke dashboardadmin.
        $this->actingAs($admin)->get('/login')->assertRedirect(route('dashboardadmin'));
    }

    // =========================
    // EXTRA: ROUTE LOGIN LEGACY SUDAH DIHAPUS
    // =========================

    public function test_route_login_legacy_tidak_tersedia(): void
    {
        // Sistem login satu halaman: /login.
        // Route legacy /login/admin dan /login/guru sudah dihapus (404).
        $this->get('/login/admin')->assertNotFound();
        $this->get('/login/guru')->assertNotFound();

        $this->post('/login/admin', [
            'username' => 'admin01',
            'password' => 'password123',
        ])->assertNotFound();

        $this->post('/login/guru', [
            'nip' => '1234567890',
            'password' => 'password123',
        ])->assertNotFound();
    }

    public function test_admin_tetap_bisa_login_via_login_utama(): void
    {
        $this->buatAdmin();

        $response = $this->post('/login', [
            'login' => 'admin01',
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('dashboardadmin'));
        $this->assertAuthenticated();
    }
}
