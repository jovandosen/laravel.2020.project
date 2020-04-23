<?php

namespace App\Services;

class Foo
{
	/**
     * Create new Foo instance
     *
     * @param  string  $x
     *
     */
	public function __construct($x)
	{
		echo $x . ' some data.';
	}
}