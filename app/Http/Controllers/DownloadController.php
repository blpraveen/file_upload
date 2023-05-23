<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\FeeImport;

class DownloadController extends Controller
{
    public function download(Request $request){
        $import = new FeeImport;
        Excel::import($import, $request->file('file')->store('files'));
        return redirect()->back();   
    }
}
