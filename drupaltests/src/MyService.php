<?php

namespace Drupal\drupaltests;

class MyService {

  protected $toNumber = [
    0 => "Nothing to count",
    1 => "I need one hand to count",
    2 => "I need one hand to count",
    3 => "I need one hand to count",
    4 => "I need one hand to count",
    5 => "I need one hand to count",
    6 => "I need two hand to count",
    7 => "I need two hand to count",
    8 => "I need two hand to count",
    9 => "I need two hand to count",
    10 => "I need two hand to count",
  ];

  public function getValue($sum) {
    return $this->toNumber[$sum];
  }
}