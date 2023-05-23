<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Database\Seeders\BranchSeeder;
use Database\Seeders\FeeCategorySeeder;
use Database\Seeders\FeeCollectionTypeSeeder;
use Database\Seeders\ModuleSeeder;
use Database\Seeders\EntryModeSeeder;
use Database\Seeders\FeeTypeSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            BranchSeeder::class,
            FeeCategorySeeder::class,
            FeeCollectionTypeSeeder::class,
            ModuleSeeder::class,
            EntryModeSeeder::class,
            FeeTypeSeeder::class,
        ]);
    }
}
