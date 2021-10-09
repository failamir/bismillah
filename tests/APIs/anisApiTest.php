<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\anis;

class anisApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_anis()
    {
        $anis = anis::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/anis', $anis
        );

        $this->assertApiResponse($anis);
    }

    /**
     * @test
     */
    public function test_read_anis()
    {
        $anis = anis::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/anis/'.$anis->id
        );

        $this->assertApiResponse($anis->toArray());
    }

    /**
     * @test
     */
    public function test_update_anis()
    {
        $anis = anis::factory()->create();
        $editedanis = anis::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/anis/'.$anis->id,
            $editedanis
        );

        $this->assertApiResponse($editedanis);
    }

    /**
     * @test
     */
    public function test_delete_anis()
    {
        $anis = anis::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/anis/'.$anis->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/anis/'.$anis->id
        );

        $this->response->assertStatus(404);
    }
}
