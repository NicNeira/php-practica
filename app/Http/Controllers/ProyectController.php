<?php

namespace App\Http\Controllers;

use App\Models\Proyect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ProyectController extends Controller
{
  /**
   * Display a listing of the projects.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $proyectos = Proyect::paginate(10);
    return view('proyects.list', compact('proyectos'));
  }

  /**
   * Show the form for creating a new project.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('proyects.create');
  }

  /**
   * Store a newly created project in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'nombre' => 'required|max:255',
      'descripcion' => 'required',
      'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
      'activo' => 'required|boolean',
    ]);

    if ($validator->fails()) {
      if ($request->ajax()) {
        return response()->json(['errors' => $validator->errors()], 422);
      }
      return redirect()->back()->withErrors($validator)->withInput();
    }

    $data = $request->all();
    $data['user_id_create'] = Auth::id();
    $data['user_id_last_update'] = Auth::id();

    if ($request->hasFile('imagen')) {
      $imagePath = $request->file('imagen')->store('project_images', 'public');
      $data['imagen'] = $imagePath;
    }

    $proyecto = Proyect::create($data);

    if ($request->ajax()) {
      return response()->json(['success' => true, 'project' => $proyecto]);
    }

    return redirect()->route('proyects.list')->with('success', 'Proyecto creado exitosamente.');
  }

  /**
   * Display the specified project.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $proyecto = Proyect::findOrFail($id);

    if (request()->ajax()) {
      return response()->json($proyecto);
    }

    return view('proyects.show', compact('proyecto'));
  }

  /**
   * Show the form for editing the specified project.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $proyecto = Proyect::findOrFail($id);

    if (request()->ajax()) {
      return response()->json($proyecto);
    }

    return view('proyects.edit', compact('proyecto'));
  }

  /**
   * Update the specified project in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $validator = Validator::make($request->all(), [
      'nombre' => 'required|max:255',
      'descripcion' => 'required',
      'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
      'activo' => 'required|boolean',
    ]);

    if ($validator->fails()) {
      if ($request->ajax()) {
        return response()->json(['errors' => $validator->errors()], 422);
      }
      return redirect()->back()->withErrors($validator)->withInput();
    }

    $proyecto = Proyect::findOrFail($id);
    $data = $request->all();
    $data['user_id_last_update'] = Auth::id();

    if ($request->hasFile('imagen')) {
      $imagePath = $request->file('imagen')->store('project_images', 'public');
      $data['imagen'] = $imagePath;
    }

    $proyecto->update($data);

    if ($request->ajax()) {
      return response()->json(['success' => true, 'project' => $proyecto]);
    }

    return redirect()->route('proyects.list')->with('success', 'Proyecto actualizado exitosamente.');
  }

  /**
   * Remove the specified project from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $proyecto = Proyect::findOrFail($id);
    $proyecto->delete();

    if (request()->ajax()) {
      return response()->json(['success' => true]);
    }

    return redirect()->route('proyects.index')->with('success', 'Proyecto eliminado exitosamente.');
  }

  // Cambiar el estado de activo a inactivo y viceversa
  /**
   * Toggles the status of a project.
   *
   * @param int $id The ID of the project.
   * @return void
   */
  public function toggleStatus($id)
  {
    $proyecto = Proyect::findOrFail($id);
    $proyecto->activo = !$proyecto->activo;
    $proyecto->save();

    return response()->json(['success' => true]);
  }
}
