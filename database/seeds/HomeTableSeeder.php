<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
class HomeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('home')->insert([
            'role' => 'Header1',
            'value' => 'LOREM IPSUM',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('home')->insert([
            'role' => 'Content1',
            'value' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('home')->insert([
            'role' => 'Our Services Search',
            'value' => 'LOREM IPSUM',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('home')->insert([
            'role' => 'Our Services Register Now',
            'value' => 'LOREM IPSUM',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('home')->insert([
            'role' => 'Our Services Marketers part',
            'value' => 'LOREM IPSUM',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('home')->insert([
            'role' => 'About US',
            'value' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and crambled it to make a type specimen book.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);


    }
}
