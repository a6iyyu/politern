<?php

namespace Database\Factories;

use App\Models\Pengguna as Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model as TModel;

class Pengguna extends Factory
{
    protected $model = Model::class;

    public function definition(): array
    {
        return [
            'nama_pengguna'     => $this->faker->userName(),
            'email'             => $this->faker->safeEmail(),
            'kata_sandi'        => bcrypt('BocchiMainGitar123!'),
            'tipe'              => $this->faker->randomElement(['ADMIN', 'MAHASISWA']),
        ];
    }

    public function create($attributes = [], ?TModel $parent = null): Collection|Model
    {
        $model = $this->make($attributes);
        $model->save();
        return $model;
    }

    public function make($attributes = [], ?TModel $parent = null): object
    {
        $definition = array_merge($this->definition(), $attributes);
        $model = $this->model;
        return new $model($definition);
    }
}