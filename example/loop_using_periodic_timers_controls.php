<?php

/**
 * ---------------------------------------------------------------------------------------------------------------------
 * DESCRIPTION
 * ---------------------------------------------------------------------------------------------------------------------
 * This file contains the example of using manually controlled periodic timers in loop.
 *
 * ---------------------------------------------------------------------------------------------------------------------
 * USAGE
 * ---------------------------------------------------------------------------------------------------------------------
 * To run this example in CLI from project root use following syntax:
 *
 * $> php ./example/loop_using_periodic_periodic_timers_controls.php
 *
 * Following flags are supported to test example with different configurations:
 *
 * --model  : define model to use, default: select, supported: [ select ]
 *
 * Ex:
 * $> php ./example/loop_using_periodic_periodic_timers_controls.php --model=select
 *
 * ---------------------------------------------------------------------------------------------------------------------
 */

$model = '';

require_once __DIR__ . '/bootstrap/autoload.php';

use Dazzle\Loop\Loop;

$loop = new Loop(new $model);
$cnt  = 0;

$func = function() use(&$cnt, &$func, $loop) {
    $cnt++;
    printf(".");
    if ($cnt % 20 === 0) {
        printf("%4s%%\n", $cnt);
    }
    if ($cnt < 100) {
        $loop->addTimer(0.05, $func);
    } else {
        $loop->stop();
    }
};
$func();

$loop->start();
