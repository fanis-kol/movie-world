<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $users = [
            ['giannis.papadopoulos@example.com', 'Giannis Papadopoulos'],
            ['maria.kalogeropoulou@example.com', 'Maria Kalogeropoulou'],
            ['nikos.konstantinou@example.com', 'Nikos Konstantinou'],
            ['eleni.dimitriou@example.com', 'Eleni Dimitriou'],
            ['vasilis.karalis@example.com', 'Vasilis Karalis'],
            ['katerina.spilioti@example.com', 'Katerina Spilioti'],
            ['giorgos.tsoukalas@example.com', 'Giorgos Tsoukalas'],
            ['stella.markou@example.com', 'Stella Markou'],
            ['panos.antoniou@example.com', 'Panos Antoniou'],
            ['sofia.georgiou@example.com', 'Sofia Georgiou'],
        ];

        foreach ($users as [$email, $name]) {
            \App\Models\User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make('password'), // Same password for all
            ]);
        }
    }
}
