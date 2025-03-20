<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use Illuminate\Http\Request;

class LibroController extends Controller
{
    public function index()
    {
        return Libro::with('autor')->get();
    }

    public function store(Request $request)
    {
        $libro = Libro::create($request->all());
        return $libro;
    }

    public function show(Libro $libro)
    {
        return $libro->load('autor');
    }

    public function update(Request $request, Libro $libro)
    {
        $libro->update($request->all());
        return $libro;
    }

    public function destroy(Libro $libro)
    {
        $libro->delete();
        return response()->json(null, 204);
    }
}
