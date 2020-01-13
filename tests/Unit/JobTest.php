<?php

namespace Tests\Unit;

use App\Job;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Session;


class JobTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    use WithFaker;
    use RefreshDatabase;

    /** @test */
    public function can_register_a_user()
    {

        $user = User::create([
            'name' => 'Mboni',
            'email' => $this->faker->email(),
            'password' => '123456',
        ]);

        $this->assertEquals('Mboni', $user->name);
    }


    /**
     * @test
     */
    public function it_allows_anyone_to_see_list_all_jobs()
    {
        $user = User::create([
            'name' => $this->faker->firstName(),
            'email' => $this->faker->email(),
            'password' => '123456',
        ]);
        $this->actingAs($user);

        $response = $this->get(route('jobs.index'));
        $response->assertResponseOk();
    }

    /**
     * @test
     */
    public function allows_users_to_see_individual_jobs()
    {

        $user = User::create([
            'name' => $this->faker->firstName(),
            'email' => $this->faker->email(),
            'password' => '123456',
        ]);
        $this->actingAs($user);

        factory(Job::class, 50)->create();
        $job = Job::get()->random();
        $response = $this->get(route('jobs.show', ['id' => $job->id]));

        $response->seePageIs('jobs/'.$job->id);
    }
    /**
     * @test
     */
    public function allows_user_to_see_users_profiles()
    {
        $user = User::create([
            'name' => $this->faker->firstName(),
            'email' => $this->faker->email(),
            'password' => '123456',
        ]);
        $this->actingAs($user);

        factory(User::class, 50)->create();
        $user = User::get()->random();
        $response = $this->get(route('users.show', ['id' => $user->id]));
        $response->seePageIs('users/'.$user->id);
    }



    /** @test */
    public function a_user_can_have_a_job()
    {

        $user = factory('App\User')->create();
//        $this->actingAs($user);
        $user->jobs()->create([
            'name' => 'Build an app',
            'jobBudget' => 2000,
            'description' => 'ahsjahjah',
            'skills' => 'laravel',
            'status' => 'alright',
            'user_id' => $user->id,
            'location' => 'kicu',
            'deadline' => '2019-06-07',
            'bidDeadline' => '2019-08-07',
            'created_at' => '2019-06-06 07:21:21',
            'updated_at' => '2019-06-06 07:21:21',
        ]);

        foreach ($user->jobs as $job)
            $this->assertEquals('Build an app', $job->name);
    }


}
