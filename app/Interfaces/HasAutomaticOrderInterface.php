<?php

namespace App\Interfaces;

interface HasAutomaticOrderInterface
{
    public function getMaxOrder(): int;
}
