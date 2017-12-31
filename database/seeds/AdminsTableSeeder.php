<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name' => 'Pharma71',
            'email' => 'admin@pharma.com',
            'password' => bcrypt('pharma123456'),
        ]);
    }
}
