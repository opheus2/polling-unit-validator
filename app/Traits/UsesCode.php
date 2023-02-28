<?php

namespace App\Traits;

trait UsesCode
{
    public function getCodeAttribute($value)
    {
        return $this->abbreviation;
    }
}
