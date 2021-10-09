<?php namespace Tests\Repositories;

use App\Models\zulan;
use App\Repositories\zulanRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class zulanRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var zulanRepository
     */
    protected $zulanRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->zulanRepo = \App::make(zulanRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_zulan()
    {
        $zulan = zulan::factory()->make()->toArray();

        $createdzulan = $this->zulanRepo->create($zulan);

        $createdzulan = $createdzulan->toArray();
        $this->assertArrayHasKey('id', $createdzulan);
        $this->assertNotNull($createdzulan['id'], 'Created zulan must have id specified');
        $this->assertNotNull(zulan::find($createdzulan['id']), 'zulan with given id must be in DB');
        $this->assertModelData($zulan, $createdzulan);
    }

    /**
     * @test read
     */
    public function test_read_zulan()
    {
        $zulan = zulan::factory()->create();

        $dbzulan = $this->zulanRepo->find($zulan->id);

        $dbzulan = $dbzulan->toArray();
        $this->assertModelData($zulan->toArray(), $dbzulan);
    }

    /**
     * @test update
     */
    public function test_update_zulan()
    {
        $zulan = zulan::factory()->create();
        $fakezulan = zulan::factory()->make()->toArray();

        $updatedzulan = $this->zulanRepo->update($fakezulan, $zulan->id);

        $this->assertModelData($fakezulan, $updatedzulan->toArray());
        $dbzulan = $this->zulanRepo->find($zulan->id);
        $this->assertModelData($fakezulan, $dbzulan->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_zulan()
    {
        $zulan = zulan::factory()->create();

        $resp = $this->zulanRepo->delete($zulan->id);

        $this->assertTrue($resp);
        $this->assertNull(zulan::find($zulan->id), 'zulan should not exist in DB');
    }
}
