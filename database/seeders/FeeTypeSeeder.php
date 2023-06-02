<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Branch;
use App\Models\FeeType;
use App\Models\FeeCategory;
use App\Models\Module;
use App\Models\FeeCollectionType;
use Illuminate\Support\Facades\DB;

class FeeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('fee_types')->truncate();

        $branches = Branch::all();
        $category = FeeCategory::all();
        $modules = Module::whereIn('module',['Academic','Academic Misc','Hostel'])->get()->keyBy('module')->toArray();

        $branches->each(function($branch)  use($category,$modules)
        {
            $cat =  $category;
            $module = array_keys($modules);
            $fct = FeeCollectionType::whereIn('name',$module);
            $fee_collection_type = $fct->where('branch_id',$branch->id)->get()->keyBy('name')->toArray();
            $cat->each(function($c) use( $branch,$fee_collection_type,$modules) {
                FeeType::create([
                    'name' => 'Tution Fee',
                    'fee_type_ledger' => 'Tution Fee',
                    'seq_id' => 1,
                    'fee_collection_type_id' => $fee_collection_type['Academic']['id'],
                    'fee_head_type_id' => $modules['Academic']['id'],
                    'fee_category_id' => $c->id,
                    'branch_id' => $branch->id
                ]);
                FeeType::create([
                    'name' => 'Exam Fee',
                    'fee_type_ledger' => 'Exam Fee',
                    'seq_id' => 2,
                    'fee_collection_type_id' => $fee_collection_type['Academic']['id'],
                    'fee_head_type_id' => $modules['Academic']['id'],
                    'fee_category_id' => $c->id,
                    'branch_id' => $branch->id
                ]);
                FeeType::create([
                    'name' => 'Adjustable Excess Amount',
                    'fee_type_ledger' => 'Adjustable Excess Amount',
                    'seq_id' => 3,
                    'fee_collection_type_id' => $fee_collection_type['Academic']['id'],
                    'fee_head_type_id' => $modules['Academic']['id'],
                    'fee_category_id' => $c->id,
                    'branch_id' => $branch->id
                ]);
                FeeType::create([
                    'name' => 'Adjusted Amount',
                    'fee_type_ledger' => 'Adjusted Amount',
                    'seq_id' => 4,
                    'fee_collection_type_id' => $fee_collection_type['Academic']['id'],
                    'fee_head_type_id' => $modules['Academic']['id'],
                    'fee_category_id' => $c->id,
                    'branch_id' => $branch->id
                ]);
                FeeType::create([
                    'name' => 'Reckecking/Scrutiny Fee',
                    'fee_type_ledger' => 'Reckecking/Scrutiny Fee',
                    'seq_id' => 5,
                    'fee_collection_type_id' => $fee_collection_type['Academic']['id'],
                    'fee_head_type_id' => $modules['Academic']['id'],
                    'fee_category_id' => $c->id,
                    'branch_id' => $branch->id
                ]);

                FeeType::create([
                    'name' => 'Fine Fee',
                    'fee_type_ledger' => 'Fine Fee',
                    'seq_id' => 6,
                    'fee_collection_type_id' => $fee_collection_type['Academic Misc']['id'],
                    'fee_head_type_id' => $modules['Academic Misc']['id'],
                    'fee_category_id' => $c->id,
                    'branch_id' => $branch->id
                ]);
                FeeType::create([
                    'name' => 'Adjustable Excess Fee',
                    'fee_type_ledger' => 'Adjustable Excess Fee',
                    'seq_id' => 7,
                    'fee_collection_type_id' => $fee_collection_type['Academic']['id'],
                    'fee_head_type_id' => $modules['Academic']['id'],
                    'fee_category_id' => $c->id,
                    'branch_id' => $branch->id
                ]);
                FeeType::create([
                    'name' => 'Tuition Fee (Back Paper)',
                    'fee_type_ledger' => 'Tuition Fee (Back Paper)',
                    'seq_id' => 8,
                    'fee_collection_type_id' => $fee_collection_type['Academic']['id'],
                    'fee_head_type_id' => $modules['Academic']['id'],
                    'fee_category_id' => $c->id,
                    'branch_id' => $branch->id
                ]);

                FeeType::create([
                    'name' => 'Tuition Fee (IBM ClaCCeC)',
                    'fee_type_ledger' => 'Tuition Fee (IBM ClaCCeC)',
                    'seq_id' => 9,
                    'fee_collection_type_id' => $fee_collection_type['Academic']['id'],
                    'fee_head_type_id' => $modules['Academic']['id'],
                    'fee_category_id' => $c->id,
                    'branch_id' => $branch->id
                ]);

                FeeType::create([
                    'name' => 'Exam Fee (CemeCter)',
                    'fee_type_ledger' => 'Exam Fee (CemeCter)',
                    'seq_id' => 10,
                    'fee_collection_type_id' => $fee_collection_type['Academic']['id'],
                    'fee_head_type_id' => $modules['Academic']['id'],
                    'fee_category_id' => $c->id,
                    'branch_id' => $branch->id
                ]);

                FeeType::create([
                    'name' => 'Library Fine Fee',
                    'fee_type_ledger' => 'Library Fine Fee',
                    'seq_id' => 11,
                    'fee_collection_type_id' => $fee_collection_type['Academic Misc']['id'],
                    'fee_head_type_id' => $modules['Academic Misc']['id'],
                    'fee_category_id' => $c->id,
                    'branch_id' => $branch->id
                ]);

                FeeType::create([
                    'name' => 'Exam Fee (Back Paper)',
                    'fee_type_ledger' => 'Exam Fee (Back Paper)',
                    'seq_id' => 12,
                    'fee_collection_type_id' => $fee_collection_type['Academic']['id'],
                    'fee_head_type_id' => $modules['Academic']['id'],
                    'fee_category_id' => $c->id,
                    'branch_id' => $branch->id
                ]);
                FeeType::create([
                    'name' => 'Degree/Convocation/Certificate Fee',
                    'fee_type_ledger' => 'Degree/Convocation/Certificate Fee',
                    'seq_id' => 13,
                    'fee_collection_type_id' => $fee_collection_type['Academic']['id'],
                    'fee_head_type_id' => $modules['Academic']['id'],
                    'fee_category_id' => $c->id,
                    'branch_id' => $branch->id
                ]);

                FeeType::create([
                    'name' => 'Library BookC Recieved',
                    'fee_type_ledger' => 'Library BookC Recieved',
                    'seq_id' => 14,
                    'fee_collection_type_id' => $fee_collection_type['Academic']['id'],
                    'fee_head_type_id' => $modules['Academic']['id'],
                    'fee_category_id' => $c->id,
                    'branch_id' => $branch->id
                ]);
                FeeType::create([
                    'name' => 'Sport Activity Received',
                    'fee_type_ledger' => 'Sport Activity Received',
                    'seq_id' => 15,
                    'fee_collection_type_id' => $fee_collection_type['Academic']['id'],
                    'fee_head_type_id' => $modules['Academic']['id'],
                    'fee_category_id' => $c->id,
                    'branch_id' => $branch->id
                ]);

                FeeType::create([
                    'name' => 'Training & Certification Fee',
                    'fee_type_ledger' => 'Training & Certification Fee',
                    'seq_id' => 16,
                    'fee_collection_type_id' => $fee_collection_type['Academic']['id'],
                    'fee_head_type_id' => $modules['Academic']['id'],
                    'fee_category_id' => $c->id,
                    'branch_id' => $branch->id
                ]);

                FeeType::create([
                    'name' => 'Training & Certification Fee',
                    'fee_type_ledger' => 'Training & Certification Fee',
                    'seq_id' => 17,
                    'fee_collection_type_id' => $fee_collection_type['Academic']['id'],
                    'fee_head_type_id' => $modules['Academic']['id'],
                    'fee_category_id' => $c->id,
                    'branch_id' => $branch->id
                ]);

                FeeType::create([
                    'name' => 'Exam Fee Debarred',
                    'fee_type_ledger' => 'Exam Fee Debarred',
                    'seq_id' => 18,
                    'fee_collection_type_id' => $fee_collection_type['Academic']['id'],
                    'fee_head_type_id' => $modules['Academic']['id'],
                    'fee_category_id' => $c->id,
                    'branch_id' => $branch->id
                ]);
                FeeType::create([
                    'name' => 'Tuition Fee Debarred',
                    'fee_type_ledger' => 'Tuition Fee Debarred',
                    'seq_id' => 19,
                    'fee_collection_type_id' => $fee_collection_type['Academic']['id'],
                    'fee_head_type_id' => $modules['Academic']['id'],
                    'fee_category_id' => $c->id,
                    'branch_id' => $branch->id
                ]);

                FeeType::create([
                    'name' => 'Exam Fees Back Paper',
                    'fee_type_ledger' => 'Exam Fees Back Paper',
                    'seq_id' => 20,
                    'fee_collection_type_id' => $fee_collection_type['Academic']['id'],
                    'fee_head_type_id' => $modules['Academic']['id'],
                    'fee_category_id' => $c->id,
                    'branch_id' => $branch->id
                ]);

                FeeType::create([
                    'name' => 'Exam Fee (Letral Deploma)',
                    'fee_type_ledger' => 'Exam Fee (Letral Deploma)',
                    'seq_id' => 21,
                    'fee_collection_type_id' => $fee_collection_type['Academic']['id'],
                    'fee_head_type_id' => $modules['Academic']['id'],
                    'fee_category_id' => $c->id,
                    'branch_id' => $branch->id
                ]);
                FeeType::create([
                    'name' => 'Exam Fees Debarred Paper',
                    'fee_type_ledger' => 'Exam Fees Debarred Paper',
                    'seq_id' => 22,
                    'fee_collection_type_id' => $fee_collection_type['Academic']['id'],
                    'fee_head_type_id' => $modules['Academic']['id'],
                    'fee_category_id' => $c->id,
                    'branch_id' => $branch->id
                ]);
                FeeType::create([
                    'name' => 'Tution Fees debarred paper',
                    'fee_type_ledger' => 'Tution Fees debarred paper',
                    'seq_id' => 23,
                    'fee_collection_type_id' => $fee_collection_type['Academic']['id'],
                    'fee_head_type_id' => $modules['Academic']['id'],
                    'fee_category_id' => $c->id,
                    'branch_id' => $branch->id
                ]);
                FeeType::create([
                    'name' => 'Convocation Fee Head',
                    'fee_type_ledger' => 'Convocation Fee Head',
                    'seq_id' => 24,
                    'fee_collection_type_id' => $fee_collection_type['Academic']['id'],
                    'fee_head_type_id' => $modules['Academic']['id'],
                    'fee_category_id' => $c->id,
                    'branch_id' => $branch->id
                ]);
                FeeType::create([
                    'name' => 'Student ID Fee',
                    'fee_type_ledger' => 'Student ID Fee',
                    'seq_id' => 25,
                    'fee_collection_type_id' => $fee_collection_type['Academic']['id'],
                    'fee_head_type_id' => $modules['Academic']['id'],
                    'fee_category_id' => $c->id,
                    'branch_id' => $branch->id
                ]);
                FeeType::create([
                    'name' => 'Library Books Recieved',
                    'fee_type_ledger' => 'Library Books Recieved',
                    'seq_id' => 26,
                    'fee_collection_type_id' => $fee_collection_type['Academic']['id'],
                    'fee_head_type_id' => $modules['Academic']['id'],
                    'fee_category_id' => $c->id,
                    'branch_id' => $branch->id
                ]);
                FeeType::create([
                    'name' => 'Special Backlog Fee',
                    'fee_type_ledger' => 'Special Backlog Fee',
                    'seq_id' => 27,
                    'fee_collection_type_id' => $fee_collection_type['Academic']['id'],
                    'fee_head_type_id' => $modules['Academic']['id'],
                    'fee_category_id' => $c->id,
                    'branch_id' => $branch->id
                ]);
                FeeType::create([
                    'name' => 'Registration Fee',
                    'fee_type_ledger' => 'Registration Fee',
                    'seq_id' => 28,
                    'fee_collection_type_id' => $fee_collection_type['Academic']['id'],
                    'fee_head_type_id' => $modules['Academic']['id'],
                    'fee_category_id' => $c->id,
                    'branch_id' => $branch->id
                ]);
                FeeType::create([
                    'name' => 'Tuition Fee (IBM Classes)',
                    'fee_type_ledger' => 'Tuition Fee (IBM Classes)',
                    'seq_id' => 29,
                    'fee_collection_type_id' => $fee_collection_type['Academic']['id'],
                    'fee_head_type_id' => $modules['Academic']['id'],
                    'fee_category_id' => $c->id,
                    'branch_id' => $branch->id
                ]);
                FeeType::create([
                    'name' => 'Registration Fine Even Sem',
                    'fee_type_ledger' => 'Registration Fine Even Sem',
                    'seq_id' => 30,
                    'fee_collection_type_id' => $fee_collection_type['Academic Misc']['id'],
                    'fee_head_type_id' => $modules['Academic Misc']['id'],
                    'fee_category_id' => $c->id,
                    'branch_id' => $branch->id
                ]);
                FeeType::create([
                    'name' => 'Online Registration Fine odd Sem',
                    'fee_type_ledger' => 'Online Registration Fine odd Sem',
                    'seq_id' => 31,
                    'fee_collection_type_id' => $fee_collection_type['Academic Misc']['id'],
                    'fee_head_type_id' => $modules['Academic Misc']['id'],
                    'fee_category_id' => $c->id,
                    'branch_id' => $branch->id
                ]);
                FeeType::create([
                    'name' => 'Revaluation Fee',
                    'fee_type_ledger' => 'Revaluation Fee',
                    'seq_id' => 32,
                    'fee_collection_type_id' => $fee_collection_type['Academic']['id'],
                    'fee_head_type_id' => $modules['Academic']['id'],
                    'fee_category_id' => $c->id,
                    'branch_id' => $branch->id
                ]);

                FeeType::create([
                    'name' => 'Rechecking Fee',
                    'fee_type_ledger' => 'Rechecking Fee',
                    'seq_id' => 33,
                    'fee_collection_type_id' => $fee_collection_type['Academic']['id'],
                    'fee_head_type_id' => $modules['Academic']['id'],
                    'fee_category_id' => $c->id,
                    'branch_id' => $branch->id
                ]);

                FeeType::create([
                    'name' => 'Indisciplinary Fine',
                    'fee_type_ledger' => 'Indisciplinary Fine',
                    'seq_id' => 34,
                    'fee_collection_type_id' => $fee_collection_type['Academic']['id'],
                    'fee_head_type_id' => $modules['Academic']['id'],
                    'fee_category_id' => $c->id,
                    'branch_id' => $branch->id
                ]);

                FeeType::create([
                    'name' => 'Exam Fee ET Eligibilty',
                    'fee_type_ledger' => 'Exam Fee ET Eligibilty',
                    'seq_id' => 35,
                    'fee_collection_type_id' => $fee_collection_type['Academic']['id'],
                    'fee_head_type_id' => $modules['Academic']['id'],
                    'fee_category_id' => $c->id,
                    'branch_id' => $branch->id
                ]);

                FeeType::create([
                    'name' => 'Online Registration Fine even Sem',
                    'fee_type_ledger' => 'Online Registration Fine even Sem',
                    'seq_id' => 36,
                    'fee_collection_type_id' => $fee_collection_type['Academic Misc']['id'],
                    'fee_head_type_id' => $modules['Academic Misc']['id'],
                    'fee_category_id' => $c->id,
                    'branch_id' => $branch->id
                ]);
                FeeType::create([
                    'name' => 'Misc Exam Fees Back Paper',
                    'fee_type_ledger' => 'Misc Exam Fees Back Paper',
                    'seq_id' => 37,
                    'fee_collection_type_id' => $fee_collection_type['Academic']['id'],
                    'fee_head_type_id' => $modules['Academic']['id'],
                    'fee_category_id' => $c->id,
                    'branch_id' => $branch->id
                ]);

                FeeType::create([
                    'name' => 'Exam Fee (Semester)',
                    'fee_type_ledger' => 'Exam Fee (Semester)',
                    'seq_id' => 38,
                    'fee_collection_type_id' => $fee_collection_type['Academic']['id'],
                    'fee_head_type_id' => $modules['Academic']['id'],
                    'fee_category_id' => $c->id,
                    'branch_id' => $branch->id
                ]);

                FeeType::create([
                    'name' => 'Thesis Fees',
                    'fee_type_ledger' => 'Thesis Fees',
                    'seq_id' => 39,
                    'fee_collection_type_id' => $fee_collection_type['Academic']['id'],
                    'fee_head_type_id' => $modules['Academic']['id'],
                    'fee_category_id' => $c->id,
                    'branch_id' => $branch->id
                ]);

                FeeType::create([
                    'name' => 'Other Fees',
                    'fee_type_ledger' => 'Other Fees',
                    'seq_id' => 40,
                    'fee_collection_type_id' => $fee_collection_type['Academic']['id'],
                    'fee_head_type_id' => $modules['Academic']['id'],
                    'fee_category_id' => $c->id,
                    'branch_id' => $branch->id
                ]);

                FeeType::create([
                    'name' => 'Tuition Fees',
                    'fee_type_ledger' => 'Tuition Fees',
                    'seq_id' => 41,
                    'fee_collection_type_id' => $fee_collection_type['Academic']['id'],
                    'fee_head_type_id' => $modules['Academic']['id'],
                    'fee_category_id' => $c->id,
                    'branch_id' => $branch->id
                ]);
                FeeType::create([
                    'name' => 'Exam Fees',
                    'fee_type_ledger' => 'Exam Fees',
                    'seq_id' => 42,
                    'fee_collection_type_id' => $fee_collection_type['Academic']['id'],
                    'fee_head_type_id' => $modules['Academic']['id'],
                    'fee_category_id' => $c->id,
                    'branch_id' => $branch->id
                ]);
                FeeType::create([
                    'name' => 'Excess Amount',
                    'fee_type_ledger' => 'Excess Amount',
                    'seq_id' => 43,
                    'fee_collection_type_id' => $fee_collection_type['Academic']['id'],
                    'fee_head_type_id' => $modules['Academic']['id'],
                    'fee_category_id' => $c->id,
                    'branch_id' => $branch->id
                ]);

                FeeType::create([
                    'name' => 'Hostel & Mess Fee',
                    'fee_type_ledger' => 'Hostel & Mess Fee',
                    'seq_id' => 44,
                    'fee_collection_type_id' => $fee_collection_type['Hostel']['id'],
                    'fee_head_type_id' => $modules['Hostel']['id'],
                    'fee_category_id' => $c->id,
                    'branch_id' => $branch->id
                ]);

                FeeType::create([
                    'name' => 'Other Fee',
                    'fee_type_ledger' => 'Other Fee',
                    'seq_id' => 45,
                    'fee_collection_type_id' => $fee_collection_type['Academic']['id'],
                    'fee_head_type_id' => $modules['Academic']['id'],
                    'fee_category_id' => $c->id,
                    'branch_id' => $branch->id
                ]);
                FeeType::create([
                    'name' => 'Degree Fees',
                    'fee_type_ledger' => 'Degree Fees',
                    'seq_id' => 46,
                    'fee_collection_type_id' => $fee_collection_type['Academic']['id'],
                    'fee_head_type_id' => $modules['Academic']['id'],
                    'fee_category_id' => $c->id,
                    'branch_id' => $branch->id
                ]);
                FeeType::create([
                    'name' => 'Registration Fine Odd Sem',
                    'fee_type_ledger' => 'Registration Fine Odd Sem',
                    'seq_id' => 47,
                    'fee_collection_type_id' => $fee_collection_type['Academic Misc']['id'],
                    'fee_head_type_id' => $modules['Academic Misc']['id'],
                    'fee_category_id' => $c->id,
                    'branch_id' => $branch->id
                ]);
                FeeType::create([
                    'name' => 'Degree Fee',
                    'fee_type_ledger' => 'Degree Fee',
                    'seq_id' => 48,
                    'fee_collection_type_id' => $fee_collection_type['Academic']['id'],
                    'fee_head_type_id' => $modules['Academic']['id'],
                    'fee_category_id' => $c->id,
                    'branch_id' => $branch->id
                ]);

                FeeType::create([
                    'name' => 'Student Id Fee Misc',
                    'fee_type_ledger' => 'Student Id Fee Misc',
                    'seq_id' => 49,
                    'fee_collection_type_id' => $fee_collection_type['Academic']['id'],
                    'fee_head_type_id' => $modules['Academic']['id'],
                    'fee_category_id' => $c->id,
                    'branch_id' => $branch->id
                ]);
            });
        });
    }
}
