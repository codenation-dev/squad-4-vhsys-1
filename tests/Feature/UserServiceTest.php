<?php


namespace Tests\Feature;


use App\Exclusion;
use App\Repositories\ExclusionRepository;
use App\Repositories\UserRepository;
use App\Services\ExclusionService;
use App\Services\UserService;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    protected $userService;

    public function setUp(): void
    {
        parent::setUp();
        $exclusionService = new ExclusionService(new ExclusionRepository(new Exclusion()), new UserRepository(new User()));
        $this->userService = new UserService(new UserRepository(new User), $exclusionService);
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

    public function testAll() {
        $data = $this->userService->all();

        $this->assertIsArray($data);
        $this->assertEquals($data['code'], 200);
    }

    public function testFindById() {
        $user = User::all()->random();
        $data = $this->userService->findById($user['id']);

        $this->assertIsArray($data);
        $this->assertEquals($data['code'], 200);
    }

    public function testFindByEmail() {
        $user = User::all()->random();

        $data = $this->userService->findByEmail($user['email']);

        $this->assertIsArray($data);
        $this->assertEquals($data['code'], 200);
    }

    public function testFindByEmailError() {
        $data = $this->userService->findByEmail('testeFail@fail.com');

        $this->assertIsArray($data);
        $this->assertEquals($data['code'], 404);
    }

    public function testUsersDelete() {
        $data = $this->userService->usersDeleted();

        $this->assertIsArray($data);
        $this->assertEquals($data['code'], 200);
    }

    public function testCreate() {
        $user = factory(User::class)->make();

        $newUser = [
            'name'     => $user->name,
            'email'       => $user->email,
            'password'    => '1234567'
        ];

        $data = $this->userService->create($newUser);

        $this->assertIsArray($data);
        $this->assertEquals($data['code'], 201);
    }

    public function testDeleteUser() {
        $this->authenticateUser();

        $user = User::all()->random();

        $data = $this->userService->delete($user['id']);

        $this->assertIsArray($data);
        $this->assertEquals($data['code'], 200);
    }

    public function testDeleteNotUser() {
        $user = User::all()->random();

        $data = $this->userService->delete($user['id']);

        $this->assertIsArray($data);
        $this->assertEquals($data['code'], 503);
    }

    public function testUpdate() {
        $user = User::all()->random();

        $this->authenticateUser();

        $newDataUser = [
            'name'      => 'TestUni',
            'email'     => $user->email,
            'password'  => $user->password
        ];

        $data = $this->userService->update($newDataUser, $user->id);

        $this->assertIsArray($data);
        $this->assertEquals($data['code'], 200);

    }

    public function testUpdateError() {
        $user = User::all()->random();

        $newDataUser = [
            'namad'      => 'TestUni',
            'email'     => $user->email,
            'password'  => $user->password
        ];

        $this->expectException(\ErrorException::class);
        $this->userService->update($newDataUser, $user->id);
    }

    public function testLogin() {
        $user = factory(User::class)->create();

        $dataLogin = [
            'email'     => $user->email,
            'password'  => '1234567'
        ];

        $data = $this->userService->login($dataLogin);

        $this->assertIsArray($data);
        $this->assertEquals($data['code'], 200);
    }

    public function testLoginError() {
        $dataLogin = [
            'email'     => 'teste@testeError.com',
            'password'  => '1234567'
        ];

        $data = $this->userService->login($dataLogin);

        $this->assertIsArray($data);
        $this->assertEquals($data['code'], 401);
    }
}
