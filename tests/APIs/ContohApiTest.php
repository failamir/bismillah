<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Contoh;

class ContohApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_contoh()
    {
        $contoh = Contoh::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/contohs', $contoh
        );

        $this->assertApiResponse($contoh);
    }

    /**
     * @test
     */
    public function test_read_contoh()
    {
        $contoh = Contoh::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/contohs/'.$contoh->id
        );

        $this->assertApiResponse($contoh->toArray());
    }

    /**
     * @test
     */
    public function test_update_contoh()
    {
        $contoh = Contoh::factory()->create();
        $editedContoh = Contoh::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/contohs/'.$contoh->id,
            $editedContoh
        );

        $this->assertApiResponse($editedContoh);
    }

    /**
     * @test
     */
    public function test_delete_contoh()
    {
        $contoh = Contoh::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/contohs/'.$contoh->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/contohs/'.$contoh->id
        );

        $this->response->assertStatus(404);
    }
}
