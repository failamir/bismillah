<?php namespace Tests\Repositories;

use App\Models\contoh;
use App\Repositories\contohRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class contohRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var contohRepository
     */
    protected $contohRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->contohRepo = \App::make(contohRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_contoh()
    {
        $contoh = contoh::factory()->make()->toArray();

        $createdcontoh = $this->contohRepo->create($contoh);

        $createdcontoh = $createdcontoh->toArray();
        $this->assertArrayHasKey('id', $createdcontoh);
        $this->assertNotNull($createdcontoh['id'], 'Created contoh must have id specified');
        $this->assertNotNull(contoh::find($createdcontoh['id']), 'contoh with given id must be in DB');
        $this->assertModelData($contoh, $createdcontoh);
    }

    /**
     * @test read
     */
    public function test_read_contoh()
    {
        $contoh = contoh::factory()->create();

        $dbcontoh = $this->contohRepo->find($contoh->id);

        $dbcontoh = $dbcontoh->toArray();
        $this->assertModelData($contoh->toArray(), $dbcontoh);
    }

    /**
     * @test update
     */
    public function test_update_contoh()
    {
        $contoh = contoh::factory()->create();
        $fakecontoh = contoh::factory()->make()->toArray();

        $updatedcontoh = $this->contohRepo->update($fakecontoh, $contoh->id);

        $this->assertModelData($fakecontoh, $updatedcontoh->toArray());
        $dbcontoh = $this->contohRepo->find($contoh->id);
        $this->assertModelData($fakecontoh, $dbcontoh->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_contoh()
    {
        $contoh = contoh::factory()->create();

        $resp = $this->contohRepo->delete($contoh->id);

        $this->assertTrue($resp);
        $this->assertNull(contoh::find($contoh->id), 'contoh should not exist in DB');
    }
}
