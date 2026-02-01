<?php
include_once 'dice.php';
class d6 extends dice
{
  public function __construct() {
    parent::__construct(6);
  }
}
