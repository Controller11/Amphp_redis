#!/usr/bin/env php
<?php

require 'vendor/autoload.php';

use Amp\Loop;
use Amp\Redis\Config;
use Amp\Redis\Redis;
use Amp\Redis\RemoteExecutor;

// Example function for CPU 100% utilisation with random Redis key-value writing

Loop::run(function () {
    // Creating multiple instances (repeat 2000) of Redis write operations for ensuring CPU 100% utilisation
    Loop::repeat(2000, function () {
        $redis = new Redis(new RemoteExecutor(Config::fromUri('redis://redis')));
        // Endless cycle with write to Redis random key-value in range 1-1000000 
        while (true) {
            $key = 'key-'. rand(1, 1000000);
            $value = 'value-'. rand(1, 1000000);
            yield $redis->set($key, $value);
        }
    });
});