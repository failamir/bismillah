<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\zulan;

class zulanApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_zulan()
    {
        $zulan = zulan::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/zulans', $zulan
        );

        $this->assertApiResponse($zulan);
    }

    /**
     * @test
     */
    public function test_read_zulan()
    {
        $zulan = zulan::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/zulans/'.$zulan->id
        );

        $this->assertApiResponse($zulan->toArray());
    }

    /**
     * @test
     */
    public function test_update_zulan()
    {
        $zulan = zulan::factory()->create();
        $editedzulan = zulan::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/zulans/'.$zulan->id,
            $editedzulan
        );

        $this->assertApiResponse($editedzulan);
    }

    /**
     * @test
     */
    public function test_delete_zulan()
    {
        $zulan = zulan::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/zulans/'.$zulan->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/zulans/'.$zulan->id
        );

        $this->response->assertStatus(404);
    }
}
