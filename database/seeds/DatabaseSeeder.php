<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call(UserTableSeeder::class);        
        $this->call('ArticleTableSeeder');    
        // $this->call('ActivityTableSeeder');

        Model::reguard();
    }
}



class ArticleTableSeeder extends Seeder
{
    public function run()
    {
        App\Article::truncate();
        factory(App\Article::class, 20)->create();
    }
}

class ActivityTableSeeder extends Seeder
{
    public function run()
    {
        App\Article::truncate();
        factory(App\Activity::class, 20)->create();
    }
}