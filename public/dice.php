<?php
declare(strict_types=1);

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
