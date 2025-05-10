<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Admin as Model;
use Database\Factories\Pengguna as Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @return void
     */

    public function admin_can_login_and_redirects_correctly(): void
    {
        $admin = (new Factory())->create([
            'tipe'       => 'ADMIN',
            'kata_sandi' => Hash::make('BocchiMainGitar123!'),
        ]);

        Model::create([
            'id_pengguna'   => $admin->id_pengguna,
            'nama'          => 'Administrator',
            'nip'           => '1234567890',
            'nomor_telepon' => '081234567890',
            'jabatan'       => 'Ketua Program Studi',
        ]);

        echo "[FITUR] Admin dengan nama $admin->nama_pengguna berhasil dibuat." . PHP_EOL;

        $credentials = [
            'nama_pengguna' => $admin->nama_pengguna,
            'kata_sandi'    => 'BocchiMainGitar123!',
        ];

        $response = $this->post(route('login'), $credentials);
        $this->assertAuthenticatedAs($admin);
        $response->assertRedirect(route('admin.dasbor'));
        echo "[FITUR] Admin dengan nama $admin->nama_pengguna berhasil masuk." . PHP_EOL;
    }

    /**
     * @test
     * @return void
     */
    public function a_user_can_logout(): void
    {
        $user = (new Factory())->create();
        $this->actingAs($user);
        echo "[FITUR] Pengguna dengan nama $user->nama_pengguna berhasil masuk." . PHP_EOL;

        $response = $this->get(route('keluar'));
        $response->assertRedirect(route('masuk'));
        $this->assertGuest();
        echo "[FITUR] Pengguna dengan nama $user->nama_pengguna berhasil keluar." . PHP_EOL;
    }
}