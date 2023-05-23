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
        DB::table('fee_types')->truncate();

        EntryMode::create([
            'entry_mode_name' => 'CONCESSION',
        ]);

        EntryMode::create([
            'entry_mode_name' => 'DUE',
        ]);

        
        EntryMode::create([
            'entry_mode_name' => 'FUNDTRANSFER',
        ]);

        
        EntryMode::create([
            'entry_mode_name' => 'JV',
        ]);
        
        EntryMode::create([
            'entry_mode_name' => 'PMT',
        ]);

        
        EntryMode::create([
            'entry_mode_name' => 'PMT',
        ]);

        EntryMode::create([
            'entry_mode_name' => 'RCPT',
        ]);

        
        EntryMode::create([
            'entry_mode_name' => 'REVCONCESSION',
        ]);

        EntryMode::create([
            'entry_mode_name' => 'REVDUE',
        ]);

        EntryMode::create([
            'entry_mode_name' => 'REVJV',
        ]);

        EntryMode::create([
            'entry_mode_name' => 'REVPMT',
        ]);
        
        EntryMode::create([
            'entry_mode_name' => 'REVRCPT',
        ]);

        EntryMode::create([
            'entry_mode_name' => 'REVSCHOLARSHIP',
        ]);

        EntryMode::create([
            'entry_mode_name' => 'SCHOLARSHIP',
        ]);

        EntryMode::create([
            'entry_mode_name' => 'VOUCHERTYPE',
        ]);
    }

}
