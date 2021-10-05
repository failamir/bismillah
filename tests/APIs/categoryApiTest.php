<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\category;

class categoryApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_category()
    {
        $category = category::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/categories', $category
        );

        $this->assertApiResponse($category);
    }

    /**
     * @test
     */
    public function test_read_category()
    {
        $category = category::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/categories/'.$category->id
        );

        $this->assertApiResponse($category->toArray());
    }

    /**
     * @test
     */
    public function test_update_category()
    {
        $category = category::factory()->create();
        $editedcategory = category::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/categories/'.$category->id,
            $editedcategory
        );

        $this->assertApiResponse($editedcategory);
    }

    /**
     * @test
     */
    public function test_delete_category()
    {
        $category = category::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/categories/'.$category->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/categories/'.$category->id
        );

        $this->response->assertStatus(404);
    }
}
