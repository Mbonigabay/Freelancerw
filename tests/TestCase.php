<?php

namespace Tests;

use Laravel\BrowserKitTesting\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public $baseUrl = 'http://localhost';

    // ...
}

//<?php
//
//namespace Tests;
//
//use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
//
//abstract class TestCase extends BaseTestCase
//{
//    use CreatesApplication;
//}
