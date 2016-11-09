<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contacts')->insert([
            'role' => 'Longitude',
            'value' => '',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('contacts')->insert([
            'role' => 'Latitude',
            'value' => '',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('contacts')->insert([
            'role' => 'Facebook',
            'value' => '',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('contacts')->insert([
            'role' => 'Twitter',
            'value' => '',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        DB::table('contacts')->insert([
            'role' => 'Pinterest',
            'value' => '',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('contacts')->insert([
            'role' => 'Google+',
            'value' => '',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('contacts')->insert([
            'role' => 'ContactEmail',
            'value' => '',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
