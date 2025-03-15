<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_product()
    {
        $data = [
            'name' => 'Producto de prueba',
            'description' => 'Descripción de prueba',
            'price' => 9.99,
        ];

        $response = $this->postJson('/api/products', $data);

        $response->assertStatus(201)
            ->assertJson($data);

        $this->assertDatabaseHas('products', $data);
    }

    public function test_can_get_all_products()
    {
        Product::factory()->count(3)->create();

        $response = $this->getJson('/api/products');

        $response->assertStatus(200)
            ->assertJsonCount(3);
    }

    public function test_can_get_a_product()
    {
        $product = Product::factory()->create();

        $response = $this->getJson('/api/products/' . $product->id);

        $response->assertStatus(200)
            ->assertJson($product->toArray());
    }

    public function test_can_update_a_product()
    {
        $product = Product::factory()->create();
        $updatedData = [
            'name' => 'Producto actualizado',
            'price' => 19.99,
        ];

        $response = $this->putJson('/api/products/' . $product->id, $updatedData);

        $response->assertStatus(200)
            ->assertJson($updatedData);

        $this->assertDatabaseHas('products', $updatedData);
    }

    public function test_can_delete_a_product()
    {
        $product = Product::factory()->create();

        $response = $this->deleteJson('/api/products/' . $product->id);

        $response->assertStatus(204);

        $this->assertDatabaseMissing('products', $product->toArray());
    }
}
