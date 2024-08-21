#!/usr/bin/env php
<?php

require 'vendor/autoload.php';

use Amp\Loop;
use Amp\Redis\Config;
use Amp\Redis\Redis;
use Amp\Redis\RemoteExecutor;
use Amp\Redis\RemoteExecutorFactory;

// Example function for CPU 100% utilisation with random Redis key-value writing

Loop::run(function () {
  // Create RemoteExecutorFactory instance
  $factory = new RemoteExecutorFactory(Config::fromUri('redis://redis'));
  // Establish Amp/Redis connection
  $redis = new Redis($factory->createQueryExecutor());  
  // Endless cycle with write to Redis random key-value in range 1-1000000 
  while (true) {
      $promises = [];
      // Creating multiple instances (1000 in this example) of Redis write operations for ensuring CPU 100% utilisation
      for ($i = 0; $i < 1000; $i++) {
          $key = 'key-'. rand(1, 1000000);
          $value = 'value-'. rand(1, 1000000);
          $promises[] = $redis->set($key, $value);
      }
      // Complete write operations in bulk
      yield \Amp\Promise\all($promises);
  }
});