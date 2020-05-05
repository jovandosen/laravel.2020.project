<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Foo;
use Psr\Container\ContainerInterface;
use DB;
use App\User;

class TestController extends Controller
{
    /**
     * Test foo
     *
     * @return void
     */
    public function foo()
    {
        $foo = new Foo('Well and good and');
    }

    /**
     * Display bar function data
     *
     * 
     */
    public function bar(ContainerInterface $container)
    {
    	echo "Some nice text to display.";
        $barService = $container->get('bar');
        echo $barService->bar();
    }

    /**
     * Display baz content
     *
     *
     */
    public function baz(ContainerInterface $container)
    {
        $bazService = $container->get('baz');
        echo $bazService->baz(1, 'Dadada');
    }

    /**
     * Display test function data
     *
     *
     */
    public function test(ContainerInterface $container)
    {
        $testService = $container->get('test');
        echo $testService->test();
    }

    /**
     * User List
     *
     * @return array | json
     */
    public function users()
    {
        $users = DB::select('select * from users');

        return $users;
    }

    /**
     * Specific User
     *
     * @return array | json
     */
    public function singleUser()
    {
        // $user = DB::select('select * from users where id = ?', [2]);

        $user = DB::select('select * from users where id = :id', ['id' => 2]); // named binding

        return $user;
    }

    /**
     * Insert User
     *
     * @return void
     */
    public function insertUser()
    {
        $user = DB::insert('insert into users (name, email, password) values (?, ?, ?)', ['Test', 'test@gmail.com', 'test123456']);
    }

    /**
     * Update User
     *
     * @return void
     */
    public function updateUser()
    {
        $user = DB::update('update users set name = ? where id = ?', ['NewUserName', 26]);
    }

    /**
     * Delete User
     *
     * @return void
     */
    public function deleteUser()
    {
        $user = DB::delete('delete from users where id = ?', [26]);
    }

    /**
     * Display json and paginated User data
     *
     * @return json
     */
    public function paginateUsers()
    {
        return User::paginate();
    }
}
