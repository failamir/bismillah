<?php namespace Tests\Repositories;

use App\Models\anis;
use App\Repositories\anisRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class anisRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var anisRepository
     */
    protected $anisRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->anisRepo = \App::make(anisRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_anis()
    {
        $anis = anis::factory()->make()->toArray();

        $createdanis = $this->anisRepo->create($anis);

        $createdanis = $createdanis->toArray();
        $this->assertArrayHasKey('id', $createdanis);
        $this->assertNotNull($createdanis['id'], 'Created anis must have id specified');
        $this->assertNotNull(anis::find($createdanis['id']), 'anis with given id must be in DB');
        $this->assertModelData($anis, $createdanis);
    }

    /**
     * @test read
     */
    public function test_read_anis()
    {
        $anis = anis::factory()->create();

        $dbanis = $this->anisRepo->find($anis->id);

        $dbanis = $dbanis->toArray();
        $this->assertModelData($anis->toArray(), $dbanis);
    }

    /**
     * @test update
     */
    public function test_update_anis()
    {
        $anis = anis::factory()->create();
        $fakeanis = anis::factory()->make()->toArray();

        $updatedanis = $this->anisRepo->update($fakeanis, $anis->id);

        $this->assertModelData($fakeanis, $updatedanis->toArray());
        $dbanis = $this->anisRepo->find($anis->id);
        $this->assertModelData($fakeanis, $dbanis->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_anis()
    {
        $anis = anis::factory()->create();

        $resp = $this->anisRepo->delete($anis->id);

        $this->assertTrue($resp);
        $this->assertNull(anis::find($anis->id), 'anis should not exist in DB');
    }
}
