#!/usr/bin/env php
<?php

require 'vendor/autoload.php';

use Amp\Loop;
use Amp\Redis\Config;
use Amp\Redis\Redis;
use Amp\Redis\RemoteExecutor;

// Example function for CPU 100% utilisation with random Redis key-value writing

Loop::run(function () {
  // Establish Amp/Redis connection
  // Important: Redis connection is outside of Amphp Loop repeat function preventing "You have reached the limits of stream_select()" exception  
  $redis = new Redis(new RemoteExecutor(Config::fromUri('redis://redis')));
  // Creating multiple instances (10 in this example) of Redis write operations for ensuring CPU 100% utilisation
  Loop::repeat(10, function () use ($redis) {
      // Endless cycle with write to Redis random key-value in range 1-1000000
      while (true) {
          $key = 'key-'. rand(1, 1000000);
          $value = 'value-'. rand(1, 1000000);
          yield $redis->set($key, $value);
      }
  });
});