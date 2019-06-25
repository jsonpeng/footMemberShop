<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Models\Setting;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(UserTableSeeder::class);
        //$this->call(SettingTableSeeder::class);

        $user = User::create([
            'name' => 'BOSS',
            'email' => '1234@123.com',
            'password'=>Hash::make('123456789'),
        ]);
        /*
        DB::table('settings')->delete();

        Setting::create([
            'tongji_limit' => 2,
            'serias_limit' => 2,
        ]);
        */
    }
}
