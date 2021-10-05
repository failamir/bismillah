<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\manager;

class managerApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_manager()
    {
        $manager = manager::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/managers', $manager
        );

        $this->assertApiResponse($manager);
    }

    /**
     * @test
     */
    public function test_read_manager()
    {
        $manager = manager::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/managers/'.$manager->id
        );

        $this->assertApiResponse($manager->toArray());
    }

    /**
     * @test
     */
    public function test_update_manager()
    {
        $manager = manager::factory()->create();
        $editedmanager = manager::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/managers/'.$manager->id,
            $editedmanager
        );

        $this->assertApiResponse($editedmanager);
    }

    /**
     * @test
     */
    public function test_delete_manager()
    {
        $manager = manager::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/managers/'.$manager->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/managers/'.$manager->id
        );

        $this->response->assertStatus(404);
    }
}
