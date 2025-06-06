<?php
namespace app\Http\Controllers; 

use Illuminate\Http\Request;


class InicioController extends Controller
{
    public function mostrarVista()
    {
        return view('incio'); // 'ejemplo' se refiere a resources/views/ejemplo.blade.php
    }
}

?>