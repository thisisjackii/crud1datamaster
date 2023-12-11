<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
        $userId = Auth::id();
        Excel::import(new PemasukanImport($userId), request()->file('file'));
        return back();
    }
}
