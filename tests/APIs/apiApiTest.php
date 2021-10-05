<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\api;

class apiApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_api()
    {
        $api = api::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/apis', $api
        );

        $this->assertApiResponse($api);
    }

    /**
     * @test
     */
    public function test_read_api()
    {
        $api = api::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/apis/'.$api->id
        );

        $this->assertApiResponse($api->toArray());
    }

    /**
     * @test
     */
    public function test_update_api()
    {
        $api = api::factory()->create();
        $editedapi = api::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/apis/'.$api->id,
            $editedapi
        );

        $this->assertApiResponse($editedapi);
    }

    /**
     * @test
     */
    public function test_delete_api()
    {
        $api = api::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/apis/'.$api->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/apis/'.$api->id
        );

        $this->response->assertStatus(404);
    }
}
