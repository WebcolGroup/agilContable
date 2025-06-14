<?php

namespace App\Infrastructure\Database\Migrations;

use App\Infrastructure\Database\Connection;

class CreateJournalTables
{
    public static function up(): void
    {
        $pdo = Connection::getPDO();

        // Tabla para el Plan Único de Cuentas (PUC)
        $pdo->exec("CREATE TABLE IF NOT EXISTS puc (
            id VARCHAR(20) PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            type VARCHAR(50) NOT NULL
        ) ENGINE=INNODB;");

        // Tabla para los asientos contables
        $pdo->exec("CREATE TABLE IF NOT EXISTS journal_entries (
            id VARCHAR(255) PRIMARY KEY,
            account_id VARCHAR(20) NOT NULL,
            description TEXT NOT NULL,
            debit DECIMAL(10, 2) DEFAULT 0,
            credit DECIMAL(10, 2) DEFAULT 0,
            date DATETIME NOT NULL,
            FOREIGN KEY (account_id) REFERENCES puc(id)
        ) ENGINE=INNODB;");
    }
}
