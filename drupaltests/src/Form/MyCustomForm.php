<?php

namespace Drupal\drupaltests\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\node\Entity\Node;

class MyCustomForm extends FormBase{

  public function getFormId() {
    return "drupaltests.myform";
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    // $form['name'] = [
    //   "#type" => "textfield",
    //   "#title" => "Name",
    // ];
    // $form['submit'] = [
    //   "#type" => "submit",
    //   "#value" => "Submit Response"
    // ];
    $node = Node::create(['type' => 'article']);
    $nodeForm = \Drupal::entityTypeManager()->getFormObject('node', 'default')->setEntity($node);
    $form = \Drupal::formBuilder()->getForm($nodeForm);
    $form['ajaxbtn'] = [
      '#type' => 'button',
      '#value' => $this->t('Submit2'),
      '#ajax' => [
        'callback' => '::myAjaxCallback',
      ],
    ];
    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    \Drupal::messenger()->addMessage("Thankyou for the response, " . $form_state->getValue("name"));
  }

  public function myAjaxCallback(array $form, FormStateInterface $form_state)
  {
    dump("test");
    die;
  }

}