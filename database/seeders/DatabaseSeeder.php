<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // User::factory(10)->create();
        $this->call(RoleSeeder::class);
        //Это Админ
        $admin = User::firstOrCreate(
          ['email'=>'admin@gmail.com'],
          [
              'name' => 'Admin',
              'password' => bcrypt('admin123'),
          ]);
          $admin->assignRole('admin');

        //Это Мэнеджер
        $manager = User::firstOrCreate(
          ['email'=>'manager@gmail.com'],
          [
            'name' => 'Обычный Менеджер',
            'password' => bcrypt('manager123'),
        ]);
        $manager->assignRole('manager');


        \App\Models\Customer::factory(10)->hasTickets(3)->create();

    }
}
