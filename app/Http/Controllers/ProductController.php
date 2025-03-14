<?php

namespace App\Http\Controllers;

use App\Repositories\Product\ProductRepositoryInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        return response()->json($this->productRepository->getAll());
    }

    public function show($id)
    {
        $product = $this->productRepository->getById($id);
        if (!$product) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }
        return response()->json($product);
    }

    public function store(Request $request)
    {
        $product = $this->productRepository->create($request->all());
        return response()->json($product, 201);
    }

    public function update(Request $request, $id)
    {
        $updated = $this->productRepository->update($id, $request->all());
        if (!$updated) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }
        return response()->json(['message' => 'Producto actualizado']);
    }

    public function destroy($id)
    {
        $deleted = $this->productRepository->delete($id);
        if (!$deleted) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }
        return response()->json(['message' => 'Producto eliminado']);
    }
}
