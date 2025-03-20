<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use Illuminate\Http\Request;

class AutorController extends Controller
{
    public function index()
    {
        return Autor::with('libros')->get();
    }

    public function store(Request $request)
    {
        $autor = Autor::create($request->all());
        return $autor;
    }

    public function show(Autor $autor)
    {
        return $autor->load('libros');
    }

    public function update(Request $request, Autor $autor)
    {
        $autor->update($request->all());
        return $autor;
    }

    public function destroy(Autor $autor)
    {
        $autor->delete();
        return response()->json(null, 204);
    }
}
