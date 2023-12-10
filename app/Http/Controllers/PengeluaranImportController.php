<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Imports\PengeluaranImport;
use Maatwebsite\Excel\Facades\Excel;

class PengeluaranImportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        Excel::import(new PengeluaranImport, request()->file('file'));
        return back();
    }
}
