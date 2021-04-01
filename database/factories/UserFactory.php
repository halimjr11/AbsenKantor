<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Num;
use Yajra\DataTables\Html\Editor\Fields\Number;
use Illuminate\Foundation\Testing\WithFaker;

class UserFactory extends Factory
{
    use WithFaker;
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
                'name' => $this->faker->name,
                'email' => $this->faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'password' => '$2y$10$843cfVxwTsAb.W1SO7RokO54SqZ52tnykdqWuUobK9hvHKZ8w80U.', // password
                'telp' => '08121212',
                'divisi'=> rand(0,5),
                'alamat' => Str::random(25),
                'level' => 'karyawan',
                'notif' => 0,
                'remember_token' => Str::random(10),
        ];
    }
}
