<?php

/**
 * ---------------------------------------------------------------------------------------------------------------------
 * DESCRIPTION
 * ---------------------------------------------------------------------------------------------------------------------
 * This file contains the example of using periodic timers in loop.
 *
 * ---------------------------------------------------------------------------------------------------------------------
 * USAGE
 * ---------------------------------------------------------------------------------------------------------------------
 * To run this example in CLI from project root use following syntax:
 *
 * $> php ./example/loop_using_periodic_periodic_timers.php
 *
 * Following flags are supported to test example with different configurations:
 *
 * --model  : define model to use, default: select, supported: [ select ]
 *
 * Ex:
 * $> php ./example/loop_using_periodic_periodic_timers.php --model=select
 *
 * ---------------------------------------------------------------------------------------------------------------------
 */

$model = '';

require_once __DIR__ . '/bootstrap/autoload.php';

use Dazzle\Loop\Loop;

$loop = new Loop(new $model);

$loop->addPeriodicTimer(0.5, function() {
    printf("This TICK will be fired each 0.5s\n");
});
$loop->addPeriodicTimer(1.3, function() {
    printf("This TICK will be fired each 1.3s\n");
});
$loop->addPeriodicTimer(2.0, function() {
    printf("This TICK will be fired each 2.0s\n");
});

$loop->start();
