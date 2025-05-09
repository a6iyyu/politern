<?php

declare(strict_types=1);

namespace Tests\Feature;

use Database\Factories\Pengguna as Factory;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    /**
     * Test if an admin user can successfully log in and is redirected to the correct dashboard.
     *
     * This test ensures that a user with the role 'ADMIN' is authenticated and redirected
     * to the admin dashboard after logging in.
     *
     * @return void
     * TODO: Fix the redirection issue where the user is not redirected to the expected route.
     */
    public function admin_user_can_login_and_redirects_correctly(): void
    {
        $admin = (new Factory())->create(['tipe' => 'ADMIN']);

        $credentials = [
            'nama_pengguna' => $admin->nama_pengguna,
            'kata_sandi'    => 'BocchiMainGitar123!',
        ];

        $response = $this->post(route('login'), $credentials);
        $this->assertAuthenticatedAs($admin);
        $response->assertRedirect(route('admin.dasbor'));
    }

    /**
     * @test
     * @return void
     */
    public function a_user_can_logout(): void
    {
        $user = (new Factory())->create();
        $this->actingAs($user);
        $response = $this->get(route('keluar'));
        $response->assertRedirect(route('masuk'));
        $this->assertGuest();
    }
}