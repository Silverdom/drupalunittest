<?php

namespace Drupal\drupaltests\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\drupaltests\MyService;
use Drupal\node\Entity\Node;
use Symfony\Component\DependencyInjection\ContainerInterface;

class MyController extends ControllerBase
{

  protected $myService;

  public function __construct(MyService $myService)
  {
    $this->myService = $myService;
  }

  public static function create(ContainerInterface $container)
  {
    return new static(
      $container->get("drupaltests.handtocount")
    );
  }

  public function content($a, $b)
  {
    return [
      "#markup" => $this->getHandCount($a, $b),
    ];
  }

  protected function getHandCount($a, $b)
  {
    $sum = $this->subVal((int) $a, (int) $b);
    $handNeeded = $this->myService->getValue($sum);

    return $handNeeded;
  }

  protected function addVal(int $a, int $b): int
  {
    return $a + $b;
  }

  public function subVal(int $a, int $b): int
  {
    return $a - $b;
  }

  public function nodeForm()
  {
    $node = Node::create(['type' => 'article']);
    $nodeForm = \Drupal::entityTypeManager()->getFormObject('node', 'default')->setEntity($node);
    $form = \Drupal::formBuilder()->getForm($nodeForm);

    unset($form['actions']['submit']);
    unset($form['#submit']);
    unset($form['#validate']);
    // $form['actions']['submit']['#ajax'] = [
    //   "callback" => "::myAjaxCallback"
    // ];
    $form['ajaxbtn'] = [
      '#type' => 'button',
      '#value' => $this->t('Submit2'),
      '#ajax' => [
        'callback' => '::myAjaxCallback',
      ],
    ];
    // dump($form);
    // die;
    $form['#attached']['libraries'][] = 'core/drupal/ajax';
    return $form;
  }

  public function myAjaxCallback(array $form, FormStateInterface $form_state)
  {
    dump("test");
    die;
  }
}
