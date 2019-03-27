<?php

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

        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();

        /*
         * Truncate table before seed
         */
        \App\Models\User::truncate();
        $this->call(UsersTableSeeder::class);

        // \App\Models\Post::truncate();
        // $this->call(PostsTableSeeder::class);

        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();
    }
}
