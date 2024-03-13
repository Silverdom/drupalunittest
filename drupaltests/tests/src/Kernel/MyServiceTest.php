<?php

namespace Drupal\Tests\drupaltests\Kernel;

use Drupal\KernelTests\KernelTestBase;

/**
 * Tests the MyService
 *
 * @group my_module
 */
class MyServiceTest extends KernelTestBase {

  /**
   * The service under test.
   *
   * @var \Drupal\my_module\MyServiceInterface
   */
  protected $myService;

  /**
   * The modules to load to run the test.
   *
   * @var array
   */
  public static $modules = [
    'testmodule',
  ];

  /**
   * {@inheritdoc}
   */
  protected function setUp(): void {
    parent::setUp();

    $this->installConfig(['testmodule']);

    $this->myService = \Drupal::service('testmodule.myservice');
  }

  public function testName() {
    $label = $this->myService->getName('my_service_test');
    $this->assertEquals("my_service_test", $label);
  }

  public function testMessage() {
    $message = $this->myService->getMesage('my_service_test');
    $this->assertEquals("my_service_test", $message);
  }

  public function testNotFound() {
    $name = $this->myService->getName();
    $this->assertNull($name);
    $message = $this->myService->getMesage();
    $this->assertNull($message);
  }
}