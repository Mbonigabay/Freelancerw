<?php

namespace Tests\Feature;

use App\User;
use App\Http\Controllers\jobsController;
use App\Job;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JobTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    /** @Test */
    public function test_jobs()
    {
        $jobs = Job::orderBy('id', 'desc')->count();
        $this->assertEquals(5, $jobs);
    }

    public function test_store()
    {
        $job = Job::create([
            'name' => 'build',
            'jobBudget' => 2000,
            'description' => 'sdasdas',
            'skills' => 'Java',
            'location' => 'ffsdfsd',
            'deadline' => '2019-05-01',
            'user_id' => 1,
        ]);

        $this->assertEquals('build', $job->name);

    }

    /** @test */
    public function user_can_login()
    {
        $user = User::create([
            'name' => 'Mboni',
            'email' => 'Mboniga@gmail.com',
            'password' => '123456',
        ]);

        $user->visit(route('login'));
        $user->type($user->user->email, 'email');
        $user->type($user->password, 'password');
        $user->press('Login');
        $user->seePageIs(route('home'));
    }
}
