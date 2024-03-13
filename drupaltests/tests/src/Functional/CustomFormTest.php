<?php

namespace Drupal\Tests\drupaltests\Functional;

use Drupal\Tests\BrowserTestBase;

class CustomFormTest extends BrowserTestBase {

  /**
   * {@inheritdoc}
   */
  protected $profile = 'standard';

  /**
   * Modules to enable.
   *
   * @var array
   */
  protected static $modules = ['drupaltests'];

  /**
   * A user with the 'Administer quick_node_clone' permission.
   *
   * @var \Drupal\user\UserInterface
   */
  protected $user;

  /**
   * {@inheritdoc}
   */
  protected function setUp(): void {
    parent::setUp();

    // Create user.
    $this->user = $this->drupalCreateUser([
      'access content',
    ]);
  }

  /**
   * Test node create.
   */
  public function testFormSubmit() {
    $this->drupalLogin($this->user);

    // Create a basic page.
    $name_value = $this->randomGenerator->word(10);
    $edit = [
      'edit-name' => $name_value,
    ];
    $this->drupalGet('test/myform');
    $this->submitForm($edit, 'Submit Response');
    $this->assertSession()->responseContains($name_value);
  }
}