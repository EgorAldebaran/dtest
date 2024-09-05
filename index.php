<?php

require 'vendor/autoload.php';

use Dtest\CasualModel;

$rangeMax = 20;
$iterations = 100;

$model = new CasualModel($rangeMax);
$model
    ->run($iterations);

