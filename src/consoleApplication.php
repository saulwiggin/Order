<?php

use Symfony\Component\Console\Application;
use App\Command\generateOrderCommand;

$application = new Application();

$entity;

$application->add(new generateOrderCommand($entity));

$application->run();
