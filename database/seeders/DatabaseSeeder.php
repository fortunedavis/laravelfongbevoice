<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Database\Seeders\RoleTableSeeder; 
use App\Models\User;
use App\Models\Message;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

      

        Message::factory()->count(10)->create();
        
        $this->command->info('Message seeded sucessfully');
        
        $this->call(RoleTableSeeder::class);
        $this->command->info('Role seeded sucessfully');

          
         
    }
}
