<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(1)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // \App\Models\Listing::create([
        //     'title' => 'Translator',
        //     'email' => 'naeem@islamqatamil.com',
        //     'description' => 'arabic to tamil translation',
        //     'tags' => 'arabic, tamil, translation',
        //     'company' => 'islamqa tamil',
        //     'location' => 'madeenah',
        //     'website' => 'islamqatamil.com',
        //     'status' => True
        //  ]);
        $user = \App\Models\User::factory()->create([
            'name' => 'Naeem',
            'email' => 'naeem.mailto@gmail.com',
            // 'password' => bcrypt('welcome0'),
        ]);
        \App\Models\Listing::factory(20)->create(['user_id' =>  $user->id]);
    }
}
