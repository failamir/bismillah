<?php namespace Tests\Repositories;

use App\Models\Pembiayaan;
use App\Repositories\PembiayaanRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class PembiayaanRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var PembiayaanRepository
     */
    protected $pembiayaanRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->pembiayaanRepo = \App::make(PembiayaanRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_pembiayaan()
    {
        $pembiayaan = Pembiayaan::factory()->make()->toArray();

        $createdPembiayaan = $this->pembiayaanRepo->create($pembiayaan);

        $createdPembiayaan = $createdPembiayaan->toArray();
        $this->assertArrayHasKey('id', $createdPembiayaan);
        $this->assertNotNull($createdPembiayaan['id'], 'Created Pembiayaan must have id specified');
        $this->assertNotNull(Pembiayaan::find($createdPembiayaan['id']), 'Pembiayaan with given id must be in DB');
        $this->assertModelData($pembiayaan, $createdPembiayaan);
    }

    /**
     * @test read
     */
    public function test_read_pembiayaan()
    {
        $pembiayaan = Pembiayaan::factory()->create();

        $dbPembiayaan = $this->pembiayaanRepo->find($pembiayaan->id);

        $dbPembiayaan = $dbPembiayaan->toArray();
        $this->assertModelData($pembiayaan->toArray(), $dbPembiayaan);
    }

    /**
     * @test update
     */
    public function test_update_pembiayaan()
    {
        $pembiayaan = Pembiayaan::factory()->create();
        $fakePembiayaan = Pembiayaan::factory()->make()->toArray();

        $updatedPembiayaan = $this->pembiayaanRepo->update($fakePembiayaan, $pembiayaan->id);

        $this->assertModelData($fakePembiayaan, $updatedPembiayaan->toArray());
        $dbPembiayaan = $this->pembiayaanRepo->find($pembiayaan->id);
        $this->assertModelData($fakePembiayaan, $dbPembiayaan->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_pembiayaan()
    {
        $pembiayaan = Pembiayaan::factory()->create();

        $resp = $this->pembiayaanRepo->delete($pembiayaan->id);

        $this->assertTrue($resp);
        $this->assertNull(Pembiayaan::find($pembiayaan->id), 'Pembiayaan should not exist in DB');
    }
}
