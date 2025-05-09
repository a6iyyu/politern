<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Models\Pengguna;
use Faker\Factory;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * @test
     * @return void
     */
    public function can_create_user(): void
    {
        $user = Pengguna::create([
            'nama_pengguna'     => Factory::create()->userName(),
            'email'             => Factory::create()->safeEmail(),
            'kata_sandi'        => Hash::make('BocchiMainGitar123!'),
            'tipe'              => Factory::create()->randomElement(['ADMIN', 'MAHASISWA']),
        ]);

        $this->assertTrue($user->exists());
    }

    public function can_delete_user()
    {}
}