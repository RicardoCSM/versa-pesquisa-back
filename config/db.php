<?php
require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=' . $_ENV['MYSQL_HOST'] . ';dbname=' . $_ENV['MYSQL_DATABASE'],
    'username' => 'root',
    'password' => $_ENV['MYSQL_ROOT_PASSWORD'],
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
