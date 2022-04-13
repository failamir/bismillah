<?php namespace Tests\Repositories;

use App\Models\Berita;
use App\Repositories\BeritaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class BeritaRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var BeritaRepository
     */
    protected $beritaRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->beritaRepo = \App::make(BeritaRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_berita()
    {
        $berita = Berita::factory()->make()->toArray();

        $createdBerita = $this->beritaRepo->create($berita);

        $createdBerita = $createdBerita->toArray();
        $this->assertArrayHasKey('id', $createdBerita);
        $this->assertNotNull($createdBerita['id'], 'Created Berita must have id specified');
        $this->assertNotNull(Berita::find($createdBerita['id']), 'Berita with given id must be in DB');
        $this->assertModelData($berita, $createdBerita);
    }

    /**
     * @test read
     */
    public function test_read_berita()
    {
        $berita = Berita::factory()->create();

        $dbBerita = $this->beritaRepo->find($berita->id);

        $dbBerita = $dbBerita->toArray();
        $this->assertModelData($berita->toArray(), $dbBerita);
    }

    /**
     * @test update
     */
    public function test_update_berita()
    {
        $berita = Berita::factory()->create();
        $fakeBerita = Berita::factory()->make()->toArray();

        $updatedBerita = $this->beritaRepo->update($fakeBerita, $berita->id);

        $this->assertModelData($fakeBerita, $updatedBerita->toArray());
        $dbBerita = $this->beritaRepo->find($berita->id);
        $this->assertModelData($fakeBerita, $dbBerita->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_berita()
    {
        $berita = Berita::factory()->create();

        $resp = $this->beritaRepo->delete($berita->id);

        $this->assertTrue($resp);
        $this->assertNull(Berita::find($berita->id), 'Berita should not exist in DB');
    }
}
