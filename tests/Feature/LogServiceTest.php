<?php


namespace Tests\Feature;


use App\Exclusion;
use App\Log;
use App\Repositories\ExclusionRepository;
use App\Repositories\LogRepository;
use App\Repositories\UserRepository;
use App\Services\ExclusionService;
use App\Services\LogService;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class LogServiceTest extends TestCase
{
    protected $logService;

    public function setUp(): void
    {
        parent::setUp();
        $exclusionService = new ExclusionService(new ExclusionRepository(new Exclusion()), new UserRepository(new User()));
        $this->logService = new LogService(new LogRepository(new Log), $exclusionService, new UserRepository(new User()));
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

    public function createLogFake() {
        factory(Log::class)->create();
    }

    public function testAllAdmin() {
        $this->authenticateAdmin();

        $data = $this->logService->all();

        $this->assertIsArray($data);
        $this->assertEquals($data['code'], 200);
    }

    public function testAllUser() {
        $this->authenticateUser();

        $data = $this->logService->all();

        $this->assertIsArray($data);
        $this->assertEquals($data['code'], 200);
    }

    public function testNotUser() {
        $this->expectException(\ErrorException::class);

        $this->logService->all();
    }

    public function testSearchByAmbience() {
        $data = $this->logService->search(['ambience' => 'Producao']);

        $this->assertIsArray($data);
        $this->assertEquals($data['code'], 200);
    }

    public function testSearchByOrder() {
        $data = $this->logService->search(['order' => 'level']);

        $this->assertIsArray($data);
        $this->assertEquals($data['code'], 200);
    }

    public function testSearchBySearch() {
        $data = $this->logService->search(['level' => 'Warning']);

        $this->assertIsArray($data);
        $this->assertEquals($data['code'], 200);
    }

    public function testFindById() {
        $this->createLogFake();
        $log = Log::all()->random();
        $data = $this->logService->findById($log['id']);

        $this->assertIsArray($data);
        $this->assertEquals($data['code'], 200);
    }

    public function testFindByIdNotFound() {
        $log = DB::table('logs')->select('logs.id')->latest()->first();
        $log->id++;

        $data = $this->logService->findById($log->id);

        $this->assertIsArray($data);
        $this->assertEquals($data['code'], 404);
    }

    public function testCreate() {
        $this->authenticateUser();
        $log = factory(Log::class)->make();

        $newLog = [
            'level'     => $log->level      ,
            'log'       => $log->log        ,
            'events'    => $log->events     ,
            'ambience'  => $log->ambience   ,
            'status'    => $log->status     ,
            'title'     => $log->title      ,
        ];

        $data = $this->logService->create($newLog);

        $this->assertIsArray($data);
        $this->assertEquals($data['code'], 201);
    }

    public function testCreateError() {
        $this->authenticateUser();
        $log = factory(Log::class)->make();

        $newLog = [
            'levedwl'     => $log->level      ,
            'log'       => $log->log        ,
            'events'    => $log->events     ,
            'ambience'  => $log->ambience   ,
            'status'    => $log->status     ,
            'title'     => $log->title      ,
        ];

        $data = $this->logService->create($newLog);

        $this->assertIsArray($data);
        $this->assertEquals($data['code'], 503);
    }

    public function testToFile() {
        $log = Log::all()->random();

        $data = $this->logService->toFile($log['id']);

        $this->assertIsArray($data);
        $this->assertEquals($data['code'], 201);
    }

    public function testFilledUser() {
        $this->authenticateUser();

        $data = $this->logService->filled();

        $this->assertIsArray($data);
        $this->assertEquals($data['code'], 200);
    }

    public function testFilledAdmin() {
        $this->authenticateAdmin();

        $data = $this->logService->filled();

        $this->assertIsArray($data);
        $this->assertEquals($data['code'], 200);
    }

    public function testFilledNotUser() {
        $this->expectException(\ErrorException::class);
        $this->logService->filled();
    }

    public function testDestroy() {
        $this->authenticateUser();

        $log = Log::all()->random();

        $data = $this->logService->destroy($log['id']);

        $this->assertIsArray($data);
        $this->assertEquals($data['code'], 200);
    }
}
