<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Imports\PemasukanImport;
use Maatwebsite\Excel\Facades\Excel;


class PemasukanImportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        Excel::import(new PemasukanImport, request()->file('file'));
        return back();
    }
}
