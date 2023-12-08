<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Imports\PinjamanImport;
use Maatwebsite\Excel\Facades\Excel;

class PinjamanImportController extends Controller
{
    public function index()
    {
        Excel::import(new PinjamanImport, request()->file('file'));
        return back();
    }
}
