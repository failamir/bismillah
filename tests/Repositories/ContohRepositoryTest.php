<?php namespace Tests\Repositories;

use App\Models\Contoh;
use App\Repositories\ContohRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ContohRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ContohRepository
     */
    protected $contohRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->contohRepo = \App::make(ContohRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_contoh()
    {
        $contoh = Contoh::factory()->make()->toArray();

        $createdContoh = $this->contohRepo->create($contoh);

        $createdContoh = $createdContoh->toArray();
        $this->assertArrayHasKey('id', $createdContoh);
        $this->assertNotNull($createdContoh['id'], 'Created Contoh must have id specified');
        $this->assertNotNull(Contoh::find($createdContoh['id']), 'Contoh with given id must be in DB');
        $this->assertModelData($contoh, $createdContoh);
    }

    /**
     * @test read
     */
    public function test_read_contoh()
    {
        $contoh = Contoh::factory()->create();

        $dbContoh = $this->contohRepo->find($contoh->id);

        $dbContoh = $dbContoh->toArray();
        $this->assertModelData($contoh->toArray(), $dbContoh);
    }

    /**
     * @test update
     */
    public function test_update_contoh()
    {
        $contoh = Contoh::factory()->create();
        $fakeContoh = Contoh::factory()->make()->toArray();

        $updatedContoh = $this->contohRepo->update($fakeContoh, $contoh->id);

        $this->assertModelData($fakeContoh, $updatedContoh->toArray());
        $dbContoh = $this->contohRepo->find($contoh->id);
        $this->assertModelData($fakeContoh, $dbContoh->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_contoh()
    {
        $contoh = Contoh::factory()->create();

        $resp = $this->contohRepo->delete($contoh->id);

        $this->assertTrue($resp);
        $this->assertNull(Contoh::find($contoh->id), 'Contoh should not exist in DB');
    }
}
