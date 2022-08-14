<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        User::factory()
            ->hasRecordCategories(5)
            ->hasCurrencies(1)
            ->create([
                'name' => 'Javier Mercedes',
                'email' => 'manuelmercedez10@gmail.com',
                'email_verified_at' => now(),
            ]);
    }
}
