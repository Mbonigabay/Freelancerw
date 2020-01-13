<?php

namespace App;

//use Illuminate\Database\Seeder;
namespace database\seeds;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        Model::unguard();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $this->call(JobsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        Model::reguard();
    }
}
