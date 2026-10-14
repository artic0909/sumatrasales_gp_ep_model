<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InvestorController extends Controller
{
    /**
     * Display Investor Relations & Strategic Partnerships overview.
     */
    public function index()
    {
        return view('admin.investor.index');
    }
}
