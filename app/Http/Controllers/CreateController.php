<?php

namespace App\Http\Controllers;

use App\Models\Proyect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateController extends Controller
{
    public function __invoke()
    {
        return view("proyects.CreateView");
    }

    public function store(Request $request)
    {

        $request->validate([
            'nombre' => 'required',
            'fechainicio' => 'required|date',
            'estado' => 'required',
            'responsable' => 'required',
            'monto' => 'required|numeric',
        ]);


        $proyecto = new Proyect();
        $proyecto->fill($request->all());
        $proyecto->created_by = Auth::id();
        $proyecto->save();


        // En lugar de guardar, simplemente redirigimos con un mensaje de éxito. Ya que no esta conectado a una base de datos
        return redirect('/proyects')->with('success', 'Proyecto creado exitosamente');
    }
}
