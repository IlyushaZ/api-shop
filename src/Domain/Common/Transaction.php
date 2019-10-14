<?php

namespace App\Domain\Common;


interface Transaction
{
    public function makeTransaction(callable $scope);
}