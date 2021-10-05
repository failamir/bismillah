<?php namespace Tests\Repositories;

use App\Models\Laila;
use App\Repositories\LailaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class LailaRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var LailaRepository
     */
    protected $lailaRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->lailaRepo = \App::make(LailaRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_laila()
    {
        $laila = Laila::factory()->make()->toArray();

        $createdLaila = $this->lailaRepo->create($laila);

        $createdLaila = $createdLaila->toArray();
        $this->assertArrayHasKey('id', $createdLaila);
        $this->assertNotNull($createdLaila['id'], 'Created Laila must have id specified');
        $this->assertNotNull(Laila::find($createdLaila['id']), 'Laila with given id must be in DB');
        $this->assertModelData($laila, $createdLaila);
    }

    /**
     * @test read
     */
    public function test_read_laila()
    {
        $laila = Laila::factory()->create();

        $dbLaila = $this->lailaRepo->find($laila->id);

        $dbLaila = $dbLaila->toArray();
        $this->assertModelData($laila->toArray(), $dbLaila);
    }

    /**
     * @test update
     */
    public function test_update_laila()
    {
        $laila = Laila::factory()->create();
        $fakeLaila = Laila::factory()->make()->toArray();

        $updatedLaila = $this->lailaRepo->update($fakeLaila, $laila->id);

        $this->assertModelData($fakeLaila, $updatedLaila->toArray());
        $dbLaila = $this->lailaRepo->find($laila->id);
        $this->assertModelData($fakeLaila, $dbLaila->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_laila()
    {
        $laila = Laila::factory()->create();

        $resp = $this->lailaRepo->delete($laila->id);

        $this->assertTrue($resp);
        $this->assertNull(Laila::find($laila->id), 'Laila should not exist in DB');
    }
}
