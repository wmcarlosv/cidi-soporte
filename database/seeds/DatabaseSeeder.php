<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UsersTableSeeder::class);
         $this->call(DepartmentTableSeeder::class);
         $this->call(FaqsTableSeeder::class);
         $this->call(TicketsTableSeeder::class);
         $this->call(SettingsTableSeeder::class);
    }
}
