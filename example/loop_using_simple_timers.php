<?php

/**
 * ---------------------------------------------------------------------------------------------------------------------
 * DESCRIPTION
 * ---------------------------------------------------------------------------------------------------------------------
 * This file contains the example of using simple timers in loop.
 *
 * ---------------------------------------------------------------------------------------------------------------------
 * USAGE
 * ---------------------------------------------------------------------------------------------------------------------
 * To run this example in CLI from project root use following syntax:
 *
 * $> php ./example/loop_using_simple_timers.php
 *
 * Following flags are supported to test example with different configurations:
 *
 * --model  : define model to use, default: select, supported: [ select ]
 *
 * Ex:
 * $> php ./example/loop_using_simple_timers.php --model=select
 *
 * ---------------------------------------------------------------------------------------------------------------------
 */

$model = '';

require_once __DIR__ . '/bootstrap/autoload.php';

use Dazzle\Loop\Loop;

$loop = new Loop(new $model);

$loop->addTimer(0.5, function() {
    printf("This TICK will be delayed 0.5s\n");
});
$loop->addTimer(1.3, function() {
    printf("This TICK will be delayed 1.3s\n");
});
$loop->addTimer(2.0, function() {
    printf("This TICK will be delayed 2.0s\n");
});

$loop->start();
