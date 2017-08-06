<?php

/**
 * ---------------------------------------------------------------------------------------------------------------------
 * DESCRIPTION
 * ---------------------------------------------------------------------------------------------------------------------
 * This file contains the example of listening for two different types of ticks in loop.
 *
 * ---------------------------------------------------------------------------------------------------------------------
 * USAGE
 * ---------------------------------------------------------------------------------------------------------------------
 * To run this example in CLI from project root use following syntax:
 *
 * $> php ./example/loop_listening_on_ticks_all.php
 *
 * Following flags are supported to test example with different configurations:
 *
 * --model  : define model to use, default: select, supported: [ select ]
 *
 * Ex:
 * $> php ./example/loop_listening_on_ticks_all.php --model=select
 *
 * ---------------------------------------------------------------------------------------------------------------------
 */

$model = '';

require_once __DIR__ . '/bootstrap/autoload.php';

use Dazzle\Loop\Loop;

$loop = new Loop(new $model);

printf("0");

$loop->onTick(function() use($loop) {
    printf("1");
    $loop->onAfterTick(function() {
        printf("2");
    });
    $loop->onAfterTick(function() {
        printf("3");
    });
    $loop->onBeforeTick(function() {
        printf("4");
    });
    printf("5");
});

printf("6");

$loop->start();
