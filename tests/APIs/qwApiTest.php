<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\qw;

class qwApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_qw()
    {
        $qw = qw::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/qws', $qw
        );

        $this->assertApiResponse($qw);
    }

    /**
     * @test
     */
    public function test_read_qw()
    {
        $qw = qw::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/qws/'.$qw->id
        );

        $this->assertApiResponse($qw->toArray());
    }

    /**
     * @test
     */
    public function test_update_qw()
    {
        $qw = qw::factory()->create();
        $editedqw = qw::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/qws/'.$qw->id,
            $editedqw
        );

        $this->assertApiResponse($editedqw);
    }

    /**
     * @test
     */
    public function test_delete_qw()
    {
        $qw = qw::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/qws/'.$qw->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/qws/'.$qw->id
        );

        $this->response->assertStatus(404);
    }
}
