<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lelang>
 */
class LelangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $petugas = \App\Models\User::where('role', 'petugas')->pluck('id')->toArray();
        $users = \App\Models\User::where('role', 'user')->pluck('id')->toArray();
        $barangs = \App\Models\Barang::pluck('id')->toArray();

        return [
            //
            "id_user" => $this->faker->randomElement($users),
            "id_barang" => $this->faker->randomElement($barangs),
            "id_petugas" => $this->faker->randomElement($petugas),
            "tanggal" => $this->faker->date(),
            "harga_akhir" => $this->faker->randomNumber(5),
            "status" => $this->faker->randomElement(["dibuka", "ditutup"]),
        ];
    }
}
