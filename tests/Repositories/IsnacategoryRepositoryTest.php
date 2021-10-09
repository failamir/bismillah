<?php namespace Tests\Repositories;

use App\Models\Isnacategory;
use App\Repositories\IsnacategoryRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class IsnacategoryRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var IsnacategoryRepository
     */
    protected $isnacategoryRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->isnacategoryRepo = \App::make(IsnacategoryRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_isnacategory()
    {
        $isnacategory = Isnacategory::factory()->make()->toArray();

        $createdIsnacategory = $this->isnacategoryRepo->create($isnacategory);

        $createdIsnacategory = $createdIsnacategory->toArray();
        $this->assertArrayHasKey('id', $createdIsnacategory);
        $this->assertNotNull($createdIsnacategory['id'], 'Created Isnacategory must have id specified');
        $this->assertNotNull(Isnacategory::find($createdIsnacategory['id']), 'Isnacategory with given id must be in DB');
        $this->assertModelData($isnacategory, $createdIsnacategory);
    }

    /**
     * @test read
     */
    public function test_read_isnacategory()
    {
        $isnacategory = Isnacategory::factory()->create();

        $dbIsnacategory = $this->isnacategoryRepo->find($isnacategory->id);

        $dbIsnacategory = $dbIsnacategory->toArray();
        $this->assertModelData($isnacategory->toArray(), $dbIsnacategory);
    }

    /**
     * @test update
     */
    public function test_update_isnacategory()
    {
        $isnacategory = Isnacategory::factory()->create();
        $fakeIsnacategory = Isnacategory::factory()->make()->toArray();

        $updatedIsnacategory = $this->isnacategoryRepo->update($fakeIsnacategory, $isnacategory->id);

        $this->assertModelData($fakeIsnacategory, $updatedIsnacategory->toArray());
        $dbIsnacategory = $this->isnacategoryRepo->find($isnacategory->id);
        $this->assertModelData($fakeIsnacategory, $dbIsnacategory->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_isnacategory()
    {
        $isnacategory = Isnacategory::factory()->create();

        $resp = $this->isnacategoryRepo->delete($isnacategory->id);

        $this->assertTrue($resp);
        $this->assertNull(Isnacategory::find($isnacategory->id), 'Isnacategory should not exist in DB');
    }
}
