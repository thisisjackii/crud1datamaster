<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Imports\PinjamanImport;
use Maatwebsite\Excel\Facades\Excel;

class PinjamanImportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $userId = Auth::id(); // Get the user ID from the authenticated user

        Excel::import(new PinjamanImport($userId), request()->file('file'));

        return back();
    }
}
