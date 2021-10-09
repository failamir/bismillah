<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Laila;

class LailaApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_laila()
    {
        $laila = Laila::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/lailas', $laila
        );

        $this->assertApiResponse($laila);
    }

    /**
     * @test
     */
    public function test_read_laila()
    {
        $laila = Laila::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/lailas/'.$laila->id
        );

        $this->assertApiResponse($laila->toArray());
    }

    /**
     * @test
     */
    public function test_update_laila()
    {
        $laila = Laila::factory()->create();
        $editedLaila = Laila::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/lailas/'.$laila->id,
            $editedLaila
        );

        $this->assertApiResponse($editedLaila);
    }

    /**
     * @test
     */
    public function test_delete_laila()
    {
        $laila = Laila::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/lailas/'.$laila->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/lailas/'.$laila->id
        );

        $this->response->assertStatus(404);
    }
}
