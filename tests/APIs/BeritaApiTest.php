<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Berita;

class BeritaApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_berita()
    {
        $berita = Berita::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/beritas', $berita
        );

        $this->assertApiResponse($berita);
    }

    /**
     * @test
     */
    public function test_read_berita()
    {
        $berita = Berita::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/beritas/'.$berita->id
        );

        $this->assertApiResponse($berita->toArray());
    }

    /**
     * @test
     */
    public function test_update_berita()
    {
        $berita = Berita::factory()->create();
        $editedBerita = Berita::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/beritas/'.$berita->id,
            $editedBerita
        );

        $this->assertApiResponse($editedBerita);
    }

    /**
     * @test
     */
    public function test_delete_berita()
    {
        $berita = Berita::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/beritas/'.$berita->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/beritas/'.$berita->id
        );

        $this->response->assertStatus(404);
    }
}
