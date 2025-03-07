<?php

namespace App\Interfaces;

interface HasIncludableRelations
{
    public function getIncludableRelations(): array;
}
