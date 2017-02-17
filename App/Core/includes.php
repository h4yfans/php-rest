<?php


$includes = [
    '/../Model/DBConnection.php',
    '/../Controllers/Controller.php'
];

foreach ($includes as $file) {
    include_once __DIR__ . $file;
}