<?php namespace Tests\Repositories;

use App\Models\qw;
use App\Repositories\qwRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class qwRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var qwRepository
     */
    protected $qwRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->qwRepo = \App::make(qwRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_qw()
    {
        $qw = qw::factory()->make()->toArray();

        $createdqw = $this->qwRepo->create($qw);

        $createdqw = $createdqw->toArray();
        $this->assertArrayHasKey('id', $createdqw);
        $this->assertNotNull($createdqw['id'], 'Created qw must have id specified');
        $this->assertNotNull(qw::find($createdqw['id']), 'qw with given id must be in DB');
        $this->assertModelData($qw, $createdqw);
    }

    /**
     * @test read
     */
    public function test_read_qw()
    {
        $qw = qw::factory()->create();

        $dbqw = $this->qwRepo->find($qw->id);

        $dbqw = $dbqw->toArray();
        $this->assertModelData($qw->toArray(), $dbqw);
    }

    /**
     * @test update
     */
    public function test_update_qw()
    {
        $qw = qw::factory()->create();
        $fakeqw = qw::factory()->make()->toArray();

        $updatedqw = $this->qwRepo->update($fakeqw, $qw->id);

        $this->assertModelData($fakeqw, $updatedqw->toArray());
        $dbqw = $this->qwRepo->find($qw->id);
        $this->assertModelData($fakeqw, $dbqw->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_qw()
    {
        $qw = qw::factory()->create();

        $resp = $this->qwRepo->delete($qw->id);

        $this->assertTrue($resp);
        $this->assertNull(qw::find($qw->id), 'qw should not exist in DB');
    }
}
