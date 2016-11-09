<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class NotificationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notifications')->insert([
            'title' => 'question_added',
            'content' => 'Admin add question to your questionary..',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

        ]); 
        
        DB::table('notifications')->insert([
            'title' => 'answer_approved',
            'content' => 'Admin approve Your answer.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

        ]);
        
        DB::table('notifications')->insert([
            'title' => 'answer_added',
            'content' => 'User answer to question.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

        ]); 
        
        DB::table('notifications')->insert([
            'title' => 'answer_updated',
            'content' => 'User update answer to question.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

        ]);
        
        DB::table('notifications')->insert([
            'title' => 'user_registers',
            'content' => 'New user registers and wait for approve.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

        ]);
        
        DB::table('notifications')->insert([
            'title' => 'user_approved',
            'content' => 'Welcome to our team.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

        ]);

        DB::table('notifications')->insert([
            'title' => 'user_activated',
            'content' => 'User activate his account.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

        ]);

        DB::table('notifications')->insert([
            'title' => 'marketer_registers',
            'content' => 'A new marketer registers.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

        ]);

        DB::table('notifications')->insert([
            'title' => 'promo_code_uses',
            'content' => 'A new user registers with your promo code use.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

        ]);
        
    }
}
