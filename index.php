<?php

include_once __DIR__ . '/bootstrap/Bootstrap.php';

// load default classes
//
Bootstrap::loadClasses();

// load configs
//
Bootstrap::loadFromDir(__DIR__ . '/src/config');

// load models
//
Bootstrap::loadFromDir(__DIR__ . '/src/models');

// load controllers
//
Bootstrap::loadFromDir(__DIR__ . '/src/controllers');

// load services
//
Bootstrap::loadFromDir(__DIR__ . '/src/services');

// load application
//
Bootstrap::loadFromDir(__DIR__ . '/src');

// start application
//
Application::i()->start();

