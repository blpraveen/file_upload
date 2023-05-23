<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Branch;
use App\Models\FeeCategory;
use Illuminate\Support\Facades\DB;

class FeeCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('fee_types')->truncate();

        $branches = Branch::all();
        $branches->each(function($branch) 
        {
            FeeCategory::create([
                'name' => 'General',
                'description' => 'General',
                'branch_id' => $branch->id
            ]);

            FeeCategory::create([
                'name' => 'NON SAARC NRI',
                'description' => 'NON SAARC NRI',
                'branch_id' => $branch->id
            ]);

            FeeCategory::create([
                'name' => 'SAARC NRI',
                'description' => 'SAARC NRI',
                'branch_id' => $branch->id
            ]);
        });
    }
}
