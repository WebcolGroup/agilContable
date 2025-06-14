<?php

namespace App\Infrastructure\Accounting\Repositories;

use App\Domain\Accounting\Entities\Account;
use App\Domain\Accounting\Interfaces\AccountRepositoryInterface;
use App\Infrastructure\Database\Connection;

class AccountRepository implements AccountRepositoryInterface
{
    public function save(Account $account): void
    {
        $pdo = Connection::getPDO();

        $stmt = $pdo->prepare("INSERT INTO accounts (id, name, type) VALUES (:id, :name, :type)");
        $stmt->execute([
            'id' => $account->getId(),
            'name' => $account->getName(),
            'type' => $account->getType()
        ]);
    }

    public function findById(string $id): ?Account
    {
        $pdo = Connection::getPDO();

        $stmt = $pdo->prepare("SELECT * FROM puc WHERE TRIM(id) = :id");
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch();

        error_log("Querying account with ID: " . $id);
        error_log("Result: " . json_encode($data));

        if (!$data) {
            return null;
        }

        return new Account($data['id'], $data['name'], $data['type']);
    }
}
