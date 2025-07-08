<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecuperarVidasController extends Controller
{
    public function index()
    {
        return view('vistasEstudiante.recuperarVidas');
    }
}
