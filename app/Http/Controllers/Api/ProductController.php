<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 * title="Products API",
 * version="1.0.0",
 * description="API para manejar productos",
 * @OA\Contact(
 * email="your_email@example.com"
 * ),
 * @OA\License(
 * name="Apache 2.0",
 * url="http://www.apache.org/licenses/LICENSE-2.0.html"
 * )
 * )
 */

class ProductController extends Controller
{
    /**
     * @OA\Get(
     * path="/api/products",
     * summary="Listar todos los productos",
     * tags={"Productos"},
     * @OA\Response(response="200", description="Lista de productos")
     * )
     */
    public function index()
    {
        return Product::all();
    }

    /**
     * @OA\Post(
     * path="/api/products",
     * summary="Crear un nuevo producto",
     * tags={"Productos"},
     * @OA\RequestBody(
     * required=true,
     * @OA\JsonContent(
     * type="object",
     * @OA\Property(property="name", type="string"),
     * @OA\Property(property="description", type="string"),
     * @OA\Property(property="price", type="number")
     * )
     * ),
     * @OA\Response(response="201", description="Producto creado")
     * )
     */
    public function store(Request $request)
    {
        $product = Product::create($request->all());
        return response()->json($product, 201);
    }

    /**
     * @OA\Get(
     * path="/api/products/{id}",
     * summary="Obtener un producto por ID",
     * tags={"Productos"},
     * @OA\Parameter(
     * name="id",
     * in="path",
     * required=true,
     * description="ID del producto",
     * @OA\Schema(type="integer")
     * ),
     * @OA\Response(response="200", description="Detalles del producto")
     * )
     */
    public function show(Product $product)
    {
        return $product;
    }

    /**
     * @OA\Put(
     * path="/api/products/{id}",
     * summary="Actualizar un producto",
     * tags={"Productos"},
     * @OA\Parameter(
     * name="id",
     * in="path",
     * required=true,
     * description="ID del producto",
     * @OA\Schema(type="integer")
     * ),
     * @OA\RequestBody(
     * required=true,
     * @OA\JsonContent(
     * type="object",
     * @OA\Property(property="name", type="string"),
     * @OA\Property(property="description", type="string"),
     * @OA\Property(property="price", type="number")
     * )
     * ),
     * @OA\Response(response="200", description="Producto actualizado")
     * )
     */
    public function update(Request $request, Product $product)
    {
        $product->update($request->all());
        return $product;
    }

    /**
     * @OA\Delete(
     * path="/api/products/{id}",
     * summary="Eliminar un producto",
     * tags={"Productos"},
     * @OA\Parameter(
     * name="id",
     * in="path",
     * required=true,
     * description="ID del producto",
     * @OA\Schema(type="integer")
     * ),
     * @OA\Response(response="204", description="Producto eliminado")
     * )
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->noContent();
    }
}
