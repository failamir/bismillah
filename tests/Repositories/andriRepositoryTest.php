<?php namespace Tests\Repositories;

use App\Models\andri;
use App\Repositories\andriRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class andriRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var andriRepository
     */
    protected $andriRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->andriRepo = \App::make(andriRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_andri()
    {
        $andri = andri::factory()->make()->toArray();

        $createdandri = $this->andriRepo->create($andri);

        $createdandri = $createdandri->toArray();
        $this->assertArrayHasKey('id', $createdandri);
        $this->assertNotNull($createdandri['id'], 'Created andri must have id specified');
        $this->assertNotNull(andri::find($createdandri['id']), 'andri with given id must be in DB');
        $this->assertModelData($andri, $createdandri);
    }

    /**
     * @test read
     */
    public function test_read_andri()
    {
        $andri = andri::factory()->create();

        $dbandri = $this->andriRepo->find($andri->id);

        $dbandri = $dbandri->toArray();
        $this->assertModelData($andri->toArray(), $dbandri);
    }

    /**
     * @test update
     */
    public function test_update_andri()
    {
        $andri = andri::factory()->create();
        $fakeandri = andri::factory()->make()->toArray();

        $updatedandri = $this->andriRepo->update($fakeandri, $andri->id);

        $this->assertModelData($fakeandri, $updatedandri->toArray());
        $dbandri = $this->andriRepo->find($andri->id);
        $this->assertModelData($fakeandri, $dbandri->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_andri()
    {
        $andri = andri::factory()->create();

        $resp = $this->andriRepo->delete($andri->id);

        $this->assertTrue($resp);
        $this->assertNull(andri::find($andri->id), 'andri should not exist in DB');
    }
}
