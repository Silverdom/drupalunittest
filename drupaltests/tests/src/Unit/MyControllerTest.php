<?php

namespace Drupal\Tests\drupaltests\Unit;

use Drupal\drupaltests\Controller\MyController;
use Drupal\Tests\UnitTestCase;

class MyControllerTest extends UnitTestCase {

  public function providerTestAdd() {
    return [
      [4, 2, 2],
      [5, 3, 2],
      [0, 0, 0]
    ];
  }

  public function providerTestSub() {
    return [
      [0, 2, 2],
      [1, 3, 2],
      [5, 10, 5]
    ];
  }

  /**
   * Test addVal
   *
   * @dataProvider providerTestAdd
   */
  public function testAddVal($expected, $first, $second) {
    // Mock the controller to remove dependency.
    $controller = $this->getMockBuilder(MyController::class)->disableOriginalConstructor()->getMock();
    $ref_add = new \ReflectionMethod($controller, 'addVal');
    // allow access to the method
    $ref_add->setAccessible(TRUE);
    $return = $ref_add->invoke($controller, $first, $second);
    // execute assertion
    $this->assertEquals($expected, $return);
  }

  /**
   * Test subVal
   *
   * @dataProvider providerTestSub
   */
  public function testSubVal($expected, $first, $second) {
    // Mock the controller to remove dependency.
    $controller = $this->getMockBuilder(MyController::class)->disableOriginalConstructor()->getMock();
    // $controller->expects($this->any())->method('subVal');
    // $result = $controller->subVal($first, $second);
    // var_dump($result);
    // die;
    // $return = $controller->subVal($first, $second);
    
    $ref_add = new \ReflectionMethod($controller, 'subVal');
    // // allow access to the method
    $ref_add->setAccessible(TRUE);
    $return = $ref_add->invoke($controller, $first, $second);
    // execute assertion
    $this->assertEquals($expected, $return);
  }
  

  public function testGetHandCount() {
    // Mock controller dependency
    $mockService = $this->createMock('Drupal\drupaltests\MyService');
    // $mockService->expects($this->any())
    //   ->method('getValue')
    //   ->willReturnCallback(function($data) {
        
    //   })
    // $controller = new MyController();
  }

}