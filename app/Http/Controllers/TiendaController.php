<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class TiendaController extends Controller
{
    //


    public function index()
    {
        return view('VistasEstudiante.tienda');
    }

    public function pago(Request $request)
    {
        $producto = $request->query('producto');
        $precio = $request->query('precio');
        // Puedes recibir la descripción, pero no la usarás:
        //$descripcion = $request->query('descripcion');

        return view('VistasEstudiante.pagos', [
            'producto' => $producto,
            'precio' => $precio,
        ]);
    }
}
