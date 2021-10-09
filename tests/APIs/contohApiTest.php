<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\contoh;

class contohApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_contoh()
    {
        $contoh = contoh::factory()->make()->toArray();

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
        $contoh = contoh::factory()->create();

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
        $contoh = contoh::factory()->create();
        $editedcontoh = contoh::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/contohs/'.$contoh->id,
            $editedcontoh
        );

        $this->assertApiResponse($editedcontoh);
    }

    /**
     * @test
     */
    public function test_delete_contoh()
    {
        $contoh = contoh::factory()->create();

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
