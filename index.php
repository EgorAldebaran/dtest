<?php

require 'vendor/autoload.php';

use Dtest\CasualModel;

$rangeMax = 20;
$iterations = 1000;

$results = null;

$model = new CasualModel($rangeMax);
$model
    ->run($iterations)
    ->prettyLook();
