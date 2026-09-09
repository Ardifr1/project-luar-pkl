<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Lab;
use App\Models\Pelajaran;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

/*
|--------------------------------------------------------------------------
| BROKEN ROUTES TEST
|--------------------------------------------------------------------------
|
| Menguji 3 bug sisa audit yang menyebabkan 500:
|  1. GET /login/admin            -> view 'login-admin' tidak ada
|  2. GET /login/guru             -> view 'login-guru' tidak ada
|  3. GET /search-autocomplete-guru -> SearchController::autocompleteGuru tidak ada
|  4. GET /ubahpasswordguru       -> Controllerubahpassword::index tidak ada
|
| Plus regresi: GET /search-autocomplete (refactor SearchController)
|
| Tabel dibuat manual di sqlite :memory: (alasan sama dengan
| AuthFlowTest: ada migration MySQL-only). Tidak menyentuh DB produksi.
|
*/

class BrokenRoutesTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // PENGAMAN KERAS: hanya sqlite (lihat AuthFlowTest).
        if (config('database.default') !== 'sqlite') {
            self::fail(
                'KEAMANAN: test ini hanya boleh jalan di sqlite :memory:. ' .
                'Koneksi aktif: ' . config('database.default') . '.'
            );
        }

        Schema::dropIfExists('peminjaman');
        Schema::dropIfExists('lab');
        Schema::dropIfExists('pelajaran');
        Schema::dropIfExists('personal_access_tokens');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('user');

        Schema::create('user', function ($table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('username')->nullable()->unique();
            $table->string('nip')->nullable()->unique();
            $table->string('password');
            $table->string('role')->default('guru');
            $table->timestamps();
        });

        Schema::create('sessions', function ($table) {
            $table->string('id')->primary();
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

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

        Schema::create('lab', function ($table) {
            $table->id();
            $table->string('nama_lab')->unique();
            $table->integer('kapasitas_murid');
            $table->string('status')->default('tersedia');
            $table->timestamps();
        });

        Schema::create('pelajaran', function ($table) {
            $table->id();
            $table->string('nama_pelajaran', 100)->unique();
            $table->timestamps();
        });

        Schema::create('peminjaman', function ($table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('lab_id');
            $table->unsignedBigInteger('pelajaran_id');
            $table->text('keterangan')->nullable();
            $table->date('tanggal');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->string('status')->default('menunggu');
            $table->text('alasan_penolakan')->nullable();
            $table->timestamps();
        });
    }

    protected function tearDown(): void
    {
        if (config('database.default') === 'sqlite') {
            Schema::dropIfExists('peminjaman');
            Schema::dropIfExists('lab');
            Schema::dropIfExists('pelajaran');
            Schema::dropIfExists('personal_access_tokens');
            Schema::dropIfExists('sessions');
            Schema::dropIfExists('user');
        }

        parent::tearDown();
    }

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

    // =========================
    // BUG 1: HALAMAN LOGIN ADMIN
    // =========================

    public function test_bug_1_halaman_login_admin_tampil_tanpa_500(): void
    {
        $response = $this->get('/login/admin');

        $response->assertOk();
        $response->assertViewIs('login-admin');
        $response->assertSee('Login Admin');
        $response->assertSee(route('login.admin.submit'));
    }

    // =========================
    // BUG 1: HALAMAN LOGIN GURU
    // =========================

    public function test_bug_1_halaman_login_guru_tampil_tanpa_500(): void
    {
        $response = $this->get('/login/guru');

        $response->assertOk();
        $response->assertViewIs('login-guru');
        $response->assertSee('Login Guru');
        $response->assertSee(route('login.guru.submit'));
    }

    // =========================
    // BUG 2: AUTOCOMPLETE GURU
    // =========================

    public function test_bug_2_autocomplete_guru_mengembalikan_data_milik_guru(): void
    {
        $guru = $this->buatGuru();

        $lab = Lab::create([
            'nama_lab' => 'Lab Kimia',
            'kapasitas_murid' => 30,
        ]);

        $pelajaran = Pelajaran::create([
            'nama_pelajaran' => 'Kimia',
        ]);

        $pinjam = Peminjaman::create([
            'user_id' => $guru->id,
            'lab_id' => $lab->id,
            'pelajaran_id' => $pelajaran->id,
            'keterangan' => 'Pinjam lab kimia untuk praktikum',
            'tanggal' => '2026-09-01',
            'jam_mulai' => '08:00:00',
            'jam_selesai' => '10:00:00',
        ]);

        $response = $this->actingAs($guru)
            ->getJson('/search-autocomplete-guru?q=kimia');

        $response->assertOk();

        $data = $response->json();

        $this->assertIsArray($data);
        $this->assertNotEmpty($data);

        $this->assertEquals(
            'Peminjaman: Pinjam lab kimia untuk praktikum',
            $data[0]['name']
        );
        $this->assertEquals(
            route('peminjaman.edit', $pinjam->id),
            $data[0]['url']
        );
    }

    // =========================
    // BUG 2: REGRESI AUTOCOMPLETE LAMA
    // =========================

    public function test_bug_2_autocomplete_lama_tetap_berfungsi(): void
    {
        $guru = $this->buatGuru();

        $lab = Lab::create(['nama_lab' => 'Lab Fisika', 'kapasitas_murid' => 30]);
        $pelajaran = Pelajaran::create(['nama_pelajaran' => 'Fisika']);

        Peminjaman::create([
            'user_id' => $guru->id,
            'lab_id' => $lab->id,
            'pelajaran_id' => $pelajaran->id,
            'keterangan' => 'Praktikum fisika kelas X',
            'tanggal' => '2026-09-02',
            'jam_mulai' => '10:00:00',
            'jam_selesai' => '12:00:00',
        ]);

        $response = $this->actingAs($guru)
            ->getJson('/search-autocomplete?q=fisika');

        $response->assertOk();
        $this->assertEquals(
            'Peminjaman: Praktikum fisika kelas X',
            $response->json()[0]['name']
        );
    }

    // =========================
    // BUG 3: HALAMAN UBAH PASSWORD GURU
    // =========================

    public function test_bug_3_halaman_ubahpasswordguru_tampil_tanpa_500(): void
    {
        $guru = $this->buatGuru();

        $response = $this->actingAs($guru)->get('/ubahpasswordguru');

        $response->assertOk();
        $response->assertViewIs('ubahpassword');
        $response->assertSee('Masukkan Password Lama');
        $response->assertSee(route('ubah.password.update'));
    }
}
