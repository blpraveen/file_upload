<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Module;
use Illuminate\Support\Facades\DB;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('fee_types')->truncate();

        Module::create([
            'module' => 'Academic',
            'module_id' => 1
        ]);

        Module::create([
            'module' => 'Academic Misc',
            'module_id' => 11
        ]);

        Module::create([
            'module' => 'Hostel',
            'module_id' => 2
        ]);

        Module::create([
            'module' => 'Hostel Misc',
            'module_id' => 22
        ]);

        
        Module::create([
            'module' => 'Transport',
            'module_id' => 3
        ]);

        Module::create([
            'module' => 'Transport Misc',
            'module_id' => 33
        ]);
    }
}
