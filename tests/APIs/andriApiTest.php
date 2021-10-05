<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\andri;

class andriApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_andri()
    {
        $andri = andri::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/andris', $andri
        );

        $this->assertApiResponse($andri);
    }

    /**
     * @test
     */
    public function test_read_andri()
    {
        $andri = andri::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/andris/'.$andri->id
        );

        $this->assertApiResponse($andri->toArray());
    }

    /**
     * @test
     */
    public function test_update_andri()
    {
        $andri = andri::factory()->create();
        $editedandri = andri::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/andris/'.$andri->id,
            $editedandri
        );

        $this->assertApiResponse($editedandri);
    }

    /**
     * @test
     */
    public function test_delete_andri()
    {
        $andri = andri::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/andris/'.$andri->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/andris/'.$andri->id
        );

        $this->response->assertStatus(404);
    }
}
