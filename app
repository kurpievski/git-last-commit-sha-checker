#!/usr/bin/env php
<?php

require_once __DIR__.'/vendor/autoload.php';

use Symfony\Component\Console\Application;
use Console\CheckLastCommitShaCommand;

$command = new CheckLastCommitShaCommand;

$app = new Application('Check git repository last commit sha', 'v0.1.1');
$app->add($command);
$app->setDefaultCommand($command->getName());
$app->run();