<?php

namespace App\Http\Controllers;

use App\Models\Proyect;

class GetbyIdController extends Controller
{
    public function __invoke($id)
    {

        // Utiliza el método `find` para buscar el registro por su ID
        $proyectobyid = Proyect::find($id);

        // Si no se encuentra el proyecto, puedes manejar el error
        if (!$proyectobyid) {
            return redirect()->back()->with('error', 'Proyecto no encontrado');
        }

        return view("proyects.GetbyIdView", compact('proyectobyid'));
    }
}
