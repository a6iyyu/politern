<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Models\Pengguna;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function can_create_and_delete_user(): void
    {
        $user = Pengguna::create([
            'nama_pengguna'     => Factory::create()->userName(),
            'email'             => Factory::create()->safeEmail(),
            'kata_sandi'        => Hash::make('BocchiMainGitar123!'),
            'tipe'              => Factory::create()->randomElement(['ADMIN', 'MAHASISWA']),
        ]);

        $this->assertInstanceOf(Pengguna::class, $user);
        $this->assertTrue($user->exists());
        echo "[UNIT] Pengguna dengan nama $user->nama_pengguna berhasil dibuat." . PHP_EOL;

        $user->delete();
        $this->assertFalse($user->exists());
        echo "[UNIT] Pengguna dengan nama $user->nama_pengguna berhasil dihapus." . PHP_EOL;
    }
}