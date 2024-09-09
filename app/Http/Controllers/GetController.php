<?php

namespace App\Http\Controllers;

use App\Models\Proyect;

class GetController extends Controller
{
    public function __invoke()
    { {
            // Obtener todos los proyectos de la base de datos
            $lista = Proyect::paginate(10);

            // Pasar los proyectos a la vista
            return view('proyects.index', ['proyectos' => $lista]);
        }
    }
}
