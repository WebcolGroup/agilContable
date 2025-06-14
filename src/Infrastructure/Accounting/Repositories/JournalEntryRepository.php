<?php

namespace App\Infrastructure\Accounting\Repositories;

use App\Domain\Accounting\Entities\JournalEntry;
use App\Domain\Accounting\Interfaces\JournalEntryRepositoryInterface;
use App\Infrastructure\Database\Connection;

class JournalEntryRepository implements JournalEntryRepositoryInterface
{
    public function save(JournalEntry $journalEntry): void
    {
        $pdo = Connection::getPDO();

        $stmt = $pdo->prepare("INSERT INTO journal_entries (id, account_id, description, debit, credit, date) VALUES (:id, :account_id, :description, :debit, :credit, :date)");
        $stmt->execute([
            'id' => $journalEntry->getId(),
            'account_id' => $journalEntry->getAccountId(),
            'description' => $journalEntry->getDescription(),
            'debit' => $journalEntry->getDebit(),
            'credit' => $journalEntry->getCredit(),
            'date' => $journalEntry->getDate()->format('Y-m-d H:i:s')
        ]);
    }

    public function findByAccountId(string $accountId): array
    {
        $pdo = Connection::getPDO();

        $stmt = $pdo->prepare("SELECT * FROM journal_entries WHERE account_id = :account_id");
        $stmt->execute(['account_id' => $accountId]);

        return $stmt->fetchAll();
    }
}
