<?php

namespace App\Infrastructure\Accounting\Repositories;

use App\Domain\Accounting\Entities\Transaction;
use App\Domain\Accounting\Interfaces\TransactionRepositoryInterface;
use App\Infrastructure\Database\Connection;

class TransactionRepository implements TransactionRepositoryInterface
{
    public function save(Transaction $transaction): void
    {
        $pdo = Connection::getPDO();

        $stmt = $pdo->prepare("INSERT INTO transactions (id, account_id, amount, type, date) VALUES (:id, :account_id, :amount, :type, :date)");
        $stmt->execute([
            'id' => $transaction->getId(),
            'account_id' => $transaction->getAccountId(),
            'amount' => $transaction->getAmount(),
            'type' => $transaction->getType(),
            'date' => $transaction->getDate()->format('Y-m-d H:i:s')
        ]);
    }

    public function findByAccountId(string $accountId): array
    {
        $pdo = Connection::getPDO();

        $stmt = $pdo->prepare("SELECT * FROM transactions WHERE account_id = :account_id");
        $stmt->execute(['account_id' => $accountId]);

        return $stmt->fetchAll();
    }
}
