<?php namespace Tests\Repositories;

use App\Models\manager;
use App\Repositories\managerRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class managerRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var managerRepository
     */
    protected $managerRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->managerRepo = \App::make(managerRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_manager()
    {
        $manager = manager::factory()->make()->toArray();

        $createdmanager = $this->managerRepo->create($manager);

        $createdmanager = $createdmanager->toArray();
        $this->assertArrayHasKey('id', $createdmanager);
        $this->assertNotNull($createdmanager['id'], 'Created manager must have id specified');
        $this->assertNotNull(manager::find($createdmanager['id']), 'manager with given id must be in DB');
        $this->assertModelData($manager, $createdmanager);
    }

    /**
     * @test read
     */
    public function test_read_manager()
    {
        $manager = manager::factory()->create();

        $dbmanager = $this->managerRepo->find($manager->id);

        $dbmanager = $dbmanager->toArray();
        $this->assertModelData($manager->toArray(), $dbmanager);
    }

    /**
     * @test update
     */
    public function test_update_manager()
    {
        $manager = manager::factory()->create();
        $fakemanager = manager::factory()->make()->toArray();

        $updatedmanager = $this->managerRepo->update($fakemanager, $manager->id);

        $this->assertModelData($fakemanager, $updatedmanager->toArray());
        $dbmanager = $this->managerRepo->find($manager->id);
        $this->assertModelData($fakemanager, $dbmanager->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_manager()
    {
        $manager = manager::factory()->create();

        $resp = $this->managerRepo->delete($manager->id);

        $this->assertTrue($resp);
        $this->assertNull(manager::find($manager->id), 'manager should not exist in DB');
    }
}
