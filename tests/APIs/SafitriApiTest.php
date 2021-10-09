<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Safitri;

class SafitriApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_safitri()
    {
        $safitri = Safitri::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/safitris', $safitri
        );

        $this->assertApiResponse($safitri);
    }

    /**
     * @test
     */
    public function test_read_safitri()
    {
        $safitri = Safitri::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/safitris/'.$safitri->id
        );

        $this->assertApiResponse($safitri->toArray());
    }

    /**
     * @test
     */
    public function test_update_safitri()
    {
        $safitri = Safitri::factory()->create();
        $editedSafitri = Safitri::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/safitris/'.$safitri->id,
            $editedSafitri
        );

        $this->assertApiResponse($editedSafitri);
    }

    /**
     * @test
     */
    public function test_delete_safitri()
    {
        $safitri = Safitri::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/safitris/'.$safitri->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/safitris/'.$safitri->id
        );

        $this->response->assertStatus(404);
    }
}
