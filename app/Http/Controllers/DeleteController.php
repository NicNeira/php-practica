<?php

namespace App\Http\Controllers;

use App\Models\Proyect;

class DeleteController extends Controller
{
    public function destroy($id)
    {
        // Encontrar el proyecto por su ID
        $proyect = Proyect::findOrFail($id);
        
        // Eliminar el proyecto
        $proyect->delete();
        
        // Redirigir a la página de lista de proyectos con un mensaje de éxito
        return redirect()->route('proyects.home')->with('success', 'Proyecto eliminado correctamente');
    }
}
