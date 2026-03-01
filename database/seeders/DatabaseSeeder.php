<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Check if admin already exists to prevent duplicate entry errors
        $adminEmail = 'admin@edoc.com';
        $adminPassword = '123';

        if (!DB::table('admin')->where('aemail', $adminEmail)->exists()) {
            DB::table('admin')->insert([
                'aemail' => $adminEmail,
                'apassword' => $adminPassword
            ]);

            DB::table('webuser')->insert([
                'email' => $adminEmail,
                'usertype' => 'a'
            ]);

            $this->command->info("Admin superaccount created successfully!");
            $this->command->info("Email: {$adminEmail}");
            $this->command->info("Password: {$adminPassword}");
        }
        else {
            $this->command->info("Admin account already exists.");
        }
    }
}
