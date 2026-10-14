<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display Contact Inquiries & Inbound Leads inbox.
     */
    public function index()
    {
        return view('admin.contact.index');
    }
}
