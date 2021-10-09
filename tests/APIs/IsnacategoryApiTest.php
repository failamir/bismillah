<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Isnacategory;

class IsnacategoryApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_isnacategory()
    {
        $isnacategory = Isnacategory::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/isnacategories', $isnacategory
        );

        $this->assertApiResponse($isnacategory);
    }

    /**
     * @test
     */
    public function test_read_isnacategory()
    {
        $isnacategory = Isnacategory::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/isnacategories/'.$isnacategory->id
        );

        $this->assertApiResponse($isnacategory->toArray());
    }

    /**
     * @test
     */
    public function test_update_isnacategory()
    {
        $isnacategory = Isnacategory::factory()->create();
        $editedIsnacategory = Isnacategory::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/isnacategories/'.$isnacategory->id,
            $editedIsnacategory
        );

        $this->assertApiResponse($editedIsnacategory);
    }

    /**
     * @test
     */
    public function test_delete_isnacategory()
    {
        $isnacategory = Isnacategory::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/isnacategories/'.$isnacategory->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/isnacategories/'.$isnacategory->id
        );

        $this->response->assertStatus(404);
    }
}
