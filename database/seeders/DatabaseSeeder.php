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
        $this->call(ProductSeeder::class);
        $this->call(FinancialSeeder::class);
        $this->call(ShareHoldersSeeder::class);
        $this->call(CorporateSeeder::class);
        $this->call(CsrSeeder::class);
    }
}
