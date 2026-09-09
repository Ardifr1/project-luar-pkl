<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /*
    |--------------------------------------------------------------------------
    | PENGAMAN ENVIRONMENT UNTUK TESTING
    |--------------------------------------------------------------------------
    |
    | Di Windows, variabel environment OS (mis. DB_CONNECTION=mysql dari
    | shell Git Bash) bocor ke PHP melalui $_SERVER. Laravel membaca env
    | dari $_ENV + $_SERVER, sehingga phpunit.xml -- bahkan dengan
    | force="true" -- tetap bisa kalah dan aplikasi test terkoneksi ke
    | database MySQL produksi.
    |
    | Bootstrap ini menyamakan KETIGA sumber env ($_ENV, $_SERVER, putenv)
    | SEBELUM aplikasi di-boot, lalu memaksa nilai testing yang aman.
    |
    | Hanya berlaku untuk phpunit/artisan test; tidak mempengaruhi
    | aplikasi web maupun database produksi.
    |
    */

    protected function setUp(): void
    {
        // Paksa environment testing di semua sumber env yang dibaca Laravel.
        $forced = [
            'APP_ENV'        => 'testing',
            'DB_CONNECTION'  => 'sqlite',
            'DB_DATABASE'    => ':memory:',
            'DB_URL'         => '',
            'SESSION_DRIVER' => 'array',
            'SESSION_PATH'   => '/',
        ];

        foreach ($forced as $key => $value) {
            $_ENV[$key] = $value;
            $_SERVER[$key] = $value;
            putenv("$key=$value");
        }

        parent::setUp();
    }
}
