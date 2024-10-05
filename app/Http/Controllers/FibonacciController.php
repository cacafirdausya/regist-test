<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FibonacciController extends Controller
{
    public function index()
    {
        return view('fibonacci.index');
    }

}
