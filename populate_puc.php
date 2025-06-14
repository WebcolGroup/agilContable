<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Infrastructure\Database\Connection;

$pdo = Connection::getPDO();

// Insertar cuentas del Plan Único de Cuentas (PUC)
$pucData = [
    ['id' => '1105', 'name' => 'Caja', 'type' => 'asset'],
    ['id' => '1110', 'name' => 'Bancos', 'type' => 'asset'],
    ['id' => '1305', 'name' => 'Clientes', 'type' => 'asset'],
    ['id' => '2205', 'name' => 'Proveedores', 'type' => 'liability'],
    ['id' => '2408', 'name' => 'IVA por Pagar', 'type' => 'liability'],
    ['id' => '3115', 'name' => 'Capital Social', 'type' => 'equity'],
    ['id' => '4135', 'name' => 'Ingresos por Ventas', 'type' => 'income'],
    ['id' => '5135', 'name' => 'Costos de Ventas', 'type' => 'expense']
];

foreach ($pucData as $account) {
    $stmt = $pdo->prepare("INSERT INTO puc (id, name, type) VALUES (:id, :name, :type)");
    $stmt->execute($account);
}

echo "PUC data populated successfully.\n";
