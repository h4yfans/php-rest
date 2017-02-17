<?php


use App\Controllers\Controllers;

header('Content-type: application/json');
require_once __DIR__ . '/../Core/includes.php';



$uye = json_decode(file_get_contents('php://input'));

// Post edilen json verisinden verileri değişkene ata
$eposta = $uye->{'eposta'};
$sifre  = $uye->{'sifre'};
$imza   = $uye->{'imza'};

// Yapılmak istenen methodun POST olup olmadığını kontrol et
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $result     = [];
    $controller = new Controllers($eposta, $sifre, $imza);

    $query = $controller->isPasswordEmailTrue();

    if ($query) {
        $result = $query;
    }

    echo json_encode($result, JSON_UNESCAPED_UNICODE);
}
