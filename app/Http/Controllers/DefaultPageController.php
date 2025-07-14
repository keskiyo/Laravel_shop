<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DefaultPageController extends Controller
{
    
    public function clients()
    {
        return view('clients'); 
    }

    public function kontakti()
    {
        return view('kontakti');
    }
    public function loading()
    {
        return view('layouts.loading');
    }

    public function main_page()
    {
        return view('main_page');
    }
}
