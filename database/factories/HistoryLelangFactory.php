<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HistoryLelang>
 */
class HistoryLelangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $lelangs = \App\Models\Lelang::pluck('id')->toArray();
        $users = \App\Models\User::pluck('id')->toArray();
        $barangs = \App\Models\Barang::pluck('id')->toArray();
        return [
            //
            "id_lelang" => $this->faker->randomElement($lelangs),
            "id_user" => $this->faker->randomElement($users),
            "id_barang" => $this->faker->randomElement($barangs),
            "penawaran_harga" => $this->faker->randomNumber(5),
        ];
    }
}
