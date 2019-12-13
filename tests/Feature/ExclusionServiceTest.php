<?php


namespace Tests\Feature;


use App\Exclusion;
use App\Repositories\ExclusionRepository;
use App\Repositories\UserRepository;
use App\Services\ExclusionService;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ExclusionServiceTest extends TestCase
{
    protected $exclusionService;

    public function setUp(): void
    {
        parent::setUp();

        $this->exclusionService = new ExclusionService(new ExclusionRepository(new Exclusion()), new UserRepository(new User()));
    }

    public function authenticateAdmin(){
        $user = factory(User::class)->create(
            ['Admin' => 1]
        );

        Auth::setUser($user);
    }

    public function authenticateUser () {
        $user = factory(User::class)->create(
            ['Admin' => 0]
        );

        Auth::setUser($user);
    }

    public function testAllAdmin() {
        $this->authenticateAdmin();

        $data = $this->exclusionService->all();

        $this->assertIsArray($data);
        $this->assertEquals($data['code'], 200);
    }

    public function testAllUser() {
        $this->authenticateUser();

        $data = $this->exclusionService->all();

        $this->assertIsArray($data);
        $this->assertEquals($data['code'], 200);
    }

    public function testNotUser() {
        $this->expectException(\ErrorException::class);

        $this->exclusionService->all();
    }

    public function testFindById() {
        factory(Exclusion::class)->create();

        $exclusion = Exclusion::all()->random();

        $data = $this->exclusionService->findById($exclusion['id']);

        $this->assertIsArray($data);
        $this->assertEquals($data['code'], 200);
    }

    public function testCreate() {
        $this->authenticateUser();
        $exclusion = factory(Exclusion::class)->make();

        $newExclusion = [
            'value'     => $exclusion->value,
            'type'       => $exclusion->type,
        ];

        $data = $this->exclusionService->create($newExclusion);

        $this->assertIsArray($data);
        $this->assertEquals($data['code'], 201);
    }

    public function testCreateError() {
        $this->authenticateUser();

        $exclusion = factory(Exclusion::class)->make();

        $newExclusion = [
            'valuedd'     => $exclusion->value,
            'type'      => $exclusion->type,
        ];

        $data = $this->exclusionService->create($newExclusion);

        $this->assertIsArray($data);
        $this->assertEquals($data['code'], 503);
    }
}
