<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Minmax\Base\Models\SystemLanguage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SecretSeeder::class);
        $this->call(AboutSeeder::class);
        $this->call(NewsSeeder::class);
    }
}
