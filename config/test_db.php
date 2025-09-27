<?php

file_exists(__DIR__ . '/../env.test.php') && require_once __DIR__ . '/../env.test.php';
$db = DB_CONFIG;

// $db = require __DIR__ . '/db.php';
// // test database! Important not to run tests on production or development databases
// $db['dsn'] = 'mysql:host=localhost;dbname=yii2basic_test';

return $db;
