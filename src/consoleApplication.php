<?php

use Symfony\Component\Console\Application;

$application = new Application();

$application->add(new GenerateOrderCommand());

$application->run();
