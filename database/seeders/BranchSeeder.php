<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Branch;
use Illuminate\Support\Facades\DB;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('fee_types')->truncate();

        Branch::create([
            'name' => 'Gs Polytechnic',
        ]);

        Branch::create([
            'name' => 'School of Agriculture',
        ]);

        Branch::create([
            'name' => 'School of Architecture',
        ]);

        Branch::create([
            'name' => 'School of Basic & Applied Sciences',
        ]);

        
        Branch::create([
            'name' => 'School Of Biological And Biomedical Sciences',
        ]);

        Branch::create([
            'name' => 'School of Biotechnology',
        ]);

        Branch::create([
            'name' => 'School of Business',
        ]);

        Branch::create([
            'name' => 'School of Chemical Engineering',
        ]);


        Branch::create([
            'name' => 'School of Civil Engineering',
        ]);

        
        Branch::create([
            'name' => 'School of Clinical Research & Healthcare',
        ]); 

        
        Branch::create([
            'name' => 'School of Computing Science & Engineering',
        ]); 

        
        Branch::create([
            'name' => 'School of Design',
        ]); 

        
        Branch::create([
            'name' => 'School of Education',
        ]); 

        
        Branch::create([
            'name' => 'School of Electrical Electronics & Communication Engineering',
        ]); 

        
        Branch::create([
            'name' => 'School of Finance & Commerce',
        ]); 

        Branch::create([
            'name' => 'School of Hospitality',
        ]); 

        
        Branch::create([
            'name' => 'School of Humanities & Social Sciences',
        ]); 

        
        Branch::create([
            'name' => 'School of Law',
        ]);
        
        Branch::create([
            'name' => 'School of Library & Information Science',
        ]);

        
        Branch::create([
            'name' => 'School of Logistics & Aviation Management',
        ]);

        Branch::create([
            'name' => 'School of Mechanical Engineering',
        ]); 

        
        Branch::create([
            'name' => 'School of Media & Communication Studies',
        ]);
        
        Branch::create([
            'name' => 'School of Medical and Allied Sciences',
        ]);

        Branch::create([
            'name' => 'School of Nursing',
        ]);


        
        
        
        
        

    }
}
