<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\User;
use App\Models\Message;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
        ]);
        
        $this->command->info('User seeded');

        Message::factory()->count(10)->create();
        
        $this->command->info('Message seeded sucessfully');
        
       
            // {
            //     $this->call('UserTableSeeder');
                
            //     $this->command->info('User table seeded!');
            // }
         
    }
}
