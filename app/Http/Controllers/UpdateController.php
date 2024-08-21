<?php

namespace App\Http\Controllers;

use App\Models\Proyect;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function __invoke($id)
    {
        // Obtener el proyecto por ID
        $proyect = Proyect::findOrFail($id);

        // Pasar el proyecto a la vista para editarlo
        return view("proyects.UpdateView", ['proyect' => $proyect]);
    }

    public function update(Request $request, $id)
    {
        // Validar los datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'fechainicio' => 'required|date',
            'estado' => 'required|integer',
            'responsable' => 'required|string|max:255',
            'monto' => 'required|numeric|min:0',
        ]);

        // Obtener el proyecto
        $proyect = Proyect::findOrFail($id);

        // Actualizar los campos
        $proyect->update([
            'nombre' => $request->input('nombre'),
            'fechainicio' => $request->input('fechainicio'),
            'estado' => $request->input('estado'),
            'responsable' => $request->input('responsable'),
            'monto' => $request->input('monto'),
        ]);

        // Redirigir a la vista de detalles del proyecto con un mensaje de éxito
        return redirect()->route('proyect.edit', $proyect->id)->with('success', 'Proyecto actualizado correctamente');
    }
}
