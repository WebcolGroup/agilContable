<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Infrastructure\Database\Migrations\CreateJournalTables;

CreateJournalTables::up();

echo "Journal tables created successfully.\n";
