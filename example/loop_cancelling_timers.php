<?php

/**
 * ---------------------------------------------------------------------------------------------------------------------
 * DESCRIPTION
 * ---------------------------------------------------------------------------------------------------------------------
 * This file contains the example of cancelling scheduled timers in loop using alternative way.
 *
 * ---------------------------------------------------------------------------------------------------------------------
 * USAGE
 * ---------------------------------------------------------------------------------------------------------------------
 * To run this example in CLI from project root use following syntax:
 *
 * $> php ./example/loop_cancelling_timers_alternative.php
 *
 * Following flags are supported to test example with different configurations:
 *
 * --model  : define model to use, default: select, supported: [ select ]
 *
 * Ex:
 * $> php ./example/loop_cancelling_timers_alternative.php --model=select
 *
 * ---------------------------------------------------------------------------------------------------------------------
 */

$model = '';

require_once __DIR__ . '/bootstrap/autoload.php';

use Dazzle\Loop\Loop;

$loop = new Loop(new $model);

$timer1 = $loop->addTimer(1, function() {
    printf("This tick should be executed once with 1s delay.\n");
});

$timer2 = $loop->addPeriodicTimer(0.1, function() {
    printf("This tick should be executed repeatedly with 0.1s delay.\n");
});

$loop->addTimer(0.6, function() use($loop, $timer1, $timer2) {
    $loop->cancelTimer($timer1); // this will cancel $timer1 before it could be executed
    $loop->cancelTimer($timer2); // this will cancel $timer2 after ~5 executions
    printf("Cancellation has been called on timers, nothing more will be printed!\n");
});

$loop->start();
