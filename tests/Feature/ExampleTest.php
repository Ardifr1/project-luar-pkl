<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * Root aplikasi mengarahkan guest ke halaman login.
     * (User yang sudah login diarahkan ke dashboard sesuai role;
     * skenario itu tercakup di AuthFlowTest.)
     */
    public function test_the_application_redirects_guests_to_login(): void
    {
        $response = $this->get('/');

        $response->assertRedirect(route('login'));
    }
}
