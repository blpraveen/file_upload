<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EntryMode;
use Illuminate\Support\Facades\DB;

class EntryModeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('entry_modes')->truncate();

        EntryMode::create([
            'entry_mode_name' => 'DUE',
            'crdr' => 'D',
            'entry_mode_no' => '0'
        ]);

        
        EntryMode::create([
            'entry_mode_name' => 'REVDUE',
            'crdr' => 'C',
            'entry_mode_no' => '12'
        ]);

        EntryMode::create([
            'entry_mode_name' => 'SCHOLARSHIP',
            'crdr' => 'C',
            'entry_mode_no' => '15'
        ]);
        
        EntryMode::create([
            'entry_mode_name' => 'REVSCHOLARSHIP',
            'crdr' => 'D',
            'entry_mode_no' => '16'
        ]);

        EntryMode::create([
            'entry_mode_name' => 'CONCESSION',
            'crdr' => 'C',
            'entry_mode_no' => '15' 
        ]);

        EntryMode::create([
            'entry_mode_name' => 'RCPT',
            'crdr' => 'C',
            'entry_mode_no' => '0'
        ]);

        EntryMode::create([
            'entry_mode_name' => 'REVRCPT',
            'crdr' => 'D',
            'entry_mode_no' => '0'
        ]);

        EntryMode::create([
            'entry_mode_name' => 'JV',
            'crdr' => 'C',
            'entry_mode_no' => '14'
        ]);
        
        EntryMode::create([
            'entry_mode_name' => 'REVJV',
            'crdr' => 'D',
            'entry_mode_no' => '14'
        ]);

        EntryMode::create([
            'entry_mode_name' => 'PMT',
            'crdr' => 'D',
            'entry_mode_no' => '1'
        ]);

    
         
        EntryMode::create([
            'entry_mode_name' => 'REVPMT',
            'crdr' => 'C',
            'entry_mode_no' => '1'
        ]);

       
        EntryMode::create([
            'entry_mode_name' => 'FUNDTRANSFER',
            'crdr' => 'B',
            'entry_mode_no' => '1'
        ]);

        
    }

}
