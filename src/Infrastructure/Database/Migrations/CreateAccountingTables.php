<?php

namespace App\Infrastructure\Database\Migrations;

use App\Infrastructure\Database\Connection;

class CreateAccountingTables
{
    public static function up(): void
    {
        $pdo = Connection::getPDO();

        $pdo->exec("CREATE TABLE IF NOT EXISTS accounts (
            id VARCHAR(255) PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            type VARCHAR(50) NOT NULL
        ) ENGINE=INNODB;");

        $pdo->exec("CREATE TABLE IF NOT EXISTS transactions (
            id VARCHAR(255) PRIMARY KEY,
            account_id VARCHAR(255) NOT NULL,
            amount DECIMAL(10, 2) NOT NULL,
            type VARCHAR(50) NOT NULL,
            date DATETIME NOT NULL,
            FOREIGN KEY (account_id) REFERENCES accounts(id)
        ) ENGINE=INNODB;");
    }
}
