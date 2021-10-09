<?php namespace Tests\Repositories;

use App\Models\api;
use App\Repositories\apiRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class apiRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var apiRepository
     */
    protected $apiRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->apiRepo = \App::make(apiRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_api()
    {
        $api = api::factory()->make()->toArray();

        $createdapi = $this->apiRepo->create($api);

        $createdapi = $createdapi->toArray();
        $this->assertArrayHasKey('id', $createdapi);
        $this->assertNotNull($createdapi['id'], 'Created api must have id specified');
        $this->assertNotNull(api::find($createdapi['id']), 'api with given id must be in DB');
        $this->assertModelData($api, $createdapi);
    }

    /**
     * @test read
     */
    public function test_read_api()
    {
        $api = api::factory()->create();

        $dbapi = $this->apiRepo->find($api->id);

        $dbapi = $dbapi->toArray();
        $this->assertModelData($api->toArray(), $dbapi);
    }

    /**
     * @test update
     */
    public function test_update_api()
    {
        $api = api::factory()->create();
        $fakeapi = api::factory()->make()->toArray();

        $updatedapi = $this->apiRepo->update($fakeapi, $api->id);

        $this->assertModelData($fakeapi, $updatedapi->toArray());
        $dbapi = $this->apiRepo->find($api->id);
        $this->assertModelData($fakeapi, $dbapi->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_api()
    {
        $api = api::factory()->create();

        $resp = $this->apiRepo->delete($api->id);

        $this->assertTrue($resp);
        $this->assertNull(api::find($api->id), 'api should not exist in DB');
    }
}
