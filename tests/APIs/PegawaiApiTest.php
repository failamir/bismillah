<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Pegawai;

class PegawaiApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_pegawai()
    {
        $pegawai = Pegawai::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/pegawais', $pegawai
        );

        $this->assertApiResponse($pegawai);
    }

    /**
     * @test
     */
    public function test_read_pegawai()
    {
        $pegawai = Pegawai::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/pegawais/'.$pegawai->id
        );

        $this->assertApiResponse($pegawai->toArray());
    }

    /**
     * @test
     */
    public function test_update_pegawai()
    {
        $pegawai = Pegawai::factory()->create();
        $editedPegawai = Pegawai::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/pegawais/'.$pegawai->id,
            $editedPegawai
        );

        $this->assertApiResponse($editedPegawai);
    }

    /**
     * @test
     */
    public function test_delete_pegawai()
    {
        $pegawai = Pegawai::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/pegawais/'.$pegawai->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/pegawais/'.$pegawai->id
        );

        $this->response->assertStatus(404);
    }
}
