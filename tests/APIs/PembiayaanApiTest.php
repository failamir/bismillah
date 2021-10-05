<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Pembiayaan;

class PembiayaanApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_pembiayaan()
    {
        $pembiayaan = Pembiayaan::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/pembiayaans', $pembiayaan
        );

        $this->assertApiResponse($pembiayaan);
    }

    /**
     * @test
     */
    public function test_read_pembiayaan()
    {
        $pembiayaan = Pembiayaan::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/pembiayaans/'.$pembiayaan->id
        );

        $this->assertApiResponse($pembiayaan->toArray());
    }

    /**
     * @test
     */
    public function test_update_pembiayaan()
    {
        $pembiayaan = Pembiayaan::factory()->create();
        $editedPembiayaan = Pembiayaan::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/pembiayaans/'.$pembiayaan->id,
            $editedPembiayaan
        );

        $this->assertApiResponse($editedPembiayaan);
    }

    /**
     * @test
     */
    public function test_delete_pembiayaan()
    {
        $pembiayaan = Pembiayaan::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/pembiayaans/'.$pembiayaan->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/pembiayaans/'.$pembiayaan->id
        );

        $this->response->assertStatus(404);
    }
}
