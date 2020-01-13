<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $arguments = 'Laravel';

        $response = $this->call('GET', '/index/jobs', $arguments);

        $this->assertResponseOk();
        $this->seeJson();
    }


}
