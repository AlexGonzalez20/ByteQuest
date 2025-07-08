<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AprenderController extends Controller
{
        public function index()
    {
        return view('VistasEstudiante.aprender');
    }
}
