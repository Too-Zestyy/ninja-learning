<?php
declare(strict_types=1);
if(!defined('PRIVATE_INCLUDED')) {
  die('Direct access not permitted');
}

class dice
{
  public int $sides;

  public function __construct(int $sides) {
    $this->sides = $sides;
  }

  public function roll() : int {
    return rand(1, $this->sides);
  }

}
