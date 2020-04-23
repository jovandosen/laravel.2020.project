<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Foo;
use Psr\Container\ContainerInterface;

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
    }
}
