<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Infrastructure\Database\Migrations\CreateAccountingTables;

CreateAccountingTables::up();

echo "Accounting tables created successfully.\n";
