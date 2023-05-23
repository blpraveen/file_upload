<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Branch;
use App\Models\FeeCollectionType;
use Illuminate\Support\Facades\DB;

class FeeCollectionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $branches = Branch::all();
        $branches->each(function($branch) 
        {   
            DB::table('fee_types')->truncate();

            FeeCollectionType::create([
                'name' => 'Academic',
                'description' => 'Academic',
                'branch_id' => $branch->id
            ]);

            FeeCollectionType::create([
                'name' => 'Academic Misc',
                'description' => 'Academic Misc',
                'branch_id' => $branch->id
            ]);

            FeeCollectionType::create([
                'name' => 'Hostel',
                'description' => 'Hostel',
                'branch_id' => $branch->id
            ]);

            FeeCollectionType::create([
                'name' => 'Hostel Misc',
                'description' => 'Hostel Misc',
                'branch_id' => $branch->id
            ]);

            FeeCollectionType::create([
                'name' => 'Transport',
                'description' => 'Transport',
                'branch_id' => $branch->id
            ]);
            FeeCollectionType::create([
                'name' => 'Transport Misc',
                'description' => 'Transport Misc',
                'branch_id' => $branch->id
            ]);
        });
    }
}
