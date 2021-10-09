<?php namespace Tests\Repositories;

use App\Models\Safitri;
use App\Repositories\SafitriRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class SafitriRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var SafitriRepository
     */
    protected $safitriRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->safitriRepo = \App::make(SafitriRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_safitri()
    {
        $safitri = Safitri::factory()->make()->toArray();

        $createdSafitri = $this->safitriRepo->create($safitri);

        $createdSafitri = $createdSafitri->toArray();
        $this->assertArrayHasKey('id', $createdSafitri);
        $this->assertNotNull($createdSafitri['id'], 'Created Safitri must have id specified');
        $this->assertNotNull(Safitri::find($createdSafitri['id']), 'Safitri with given id must be in DB');
        $this->assertModelData($safitri, $createdSafitri);
    }

    /**
     * @test read
     */
    public function test_read_safitri()
    {
        $safitri = Safitri::factory()->create();

        $dbSafitri = $this->safitriRepo->find($safitri->id);

        $dbSafitri = $dbSafitri->toArray();
        $this->assertModelData($safitri->toArray(), $dbSafitri);
    }

    /**
     * @test update
     */
    public function test_update_safitri()
    {
        $safitri = Safitri::factory()->create();
        $fakeSafitri = Safitri::factory()->make()->toArray();

        $updatedSafitri = $this->safitriRepo->update($fakeSafitri, $safitri->id);

        $this->assertModelData($fakeSafitri, $updatedSafitri->toArray());
        $dbSafitri = $this->safitriRepo->find($safitri->id);
        $this->assertModelData($fakeSafitri, $dbSafitri->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_safitri()
    {
        $safitri = Safitri::factory()->create();

        $resp = $this->safitriRepo->delete($safitri->id);

        $this->assertTrue($resp);
        $this->assertNull(Safitri::find($safitri->id), 'Safitri should not exist in DB');
    }
}
