<?php

use Illuminate\Database\Seeder;

class SocialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Social::insert([
            ["name"=>"facebook"],
            ["name"=>"google"]
        ]);
    }
}
