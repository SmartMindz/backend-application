<?php

namespace Tests\Feature\v1;

use Artisan;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class TimeIntervalControllerTest extends TestCase
{
  use DatabaseMigrations;

  public function setUp()
  {
    parent::setUp();

    Artisan::call('db:seed');
  }

  public function test_Create_ExpectPass()
  {
    $headers = [
      'Authorization' => 'Bearer ' . $this->getAdminToken()
    ];

    $data = [
      'task_id'   => 42,
      'user_id'   => 1,
      'start_at'  => '2017-05-11T00:00:00+08:00',
      'end_at'    => '2017-05-11T00:00:00+08:00'
    ];

    $response = $this->postJson('/api/v1/time-intervals/create', $data, $headers);

    $response->assertStatus(200);
  }

  public function test_Destroy_ExpectPass()
  {
    $headers = [
      'Authorization' => 'Bearer ' . $this->getAdminToken()
    ];

    $createResponse = $this->postJson('/api/v1/time-intervals/destroy');

    $data = [
      'id' => 1
    ];

    $response = $this->postJson('/api/v1/time-intervals/destroy', [], $headers);
    $response->assertStatus(200);
  }

  public function test_Edit_ExpectPass()
  {
    $headers = [
      'Authorization' => 'Bearer ' . $this->getAdminToken()
    ];

    $data = [
      'id'        => 1,
      'task_id'   => 1,
      'user_id'   => 1,
      'start_at'  => '1991-07-03T12:00:00+02:00',
      'end_at'    => '1992-07-03T12:00:00+02:00'
    ];

    $response = $this->postJson('/api/v1/time-intervals/edit', $data, $headers);

    $response->assertStatus(200);
  }

  public function test_List_ExpectPass()
  {
    $headers = [
      'Authorization' => 'Bearer ' . $this->getAdminToken()
    ];

    $response = $this->postJson('/api/v1/time-intervals/list', [], $headers);
    $response->assertStatus(200);
  }

  public function test_Show_ExpectPass()
  {
    $headers = [
      'Authorization' => 'Bearer ' . $this->getAdminToken()
    ];

    $data = [
      'id' => 1
    ];

    $response = $this->postJson('/api/v1/time-intervals/show', $data, $headers);

    $response->assertStatus(200);
  }
}