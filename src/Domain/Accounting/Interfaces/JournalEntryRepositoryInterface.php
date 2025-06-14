<?php

namespace App\Domain\Accounting\Interfaces;

use App\Domain\Accounting\Entities\JournalEntry;

interface JournalEntryRepositoryInterface
{
    public function save(JournalEntry $journalEntry): void;
    public function findByAccountId(string $accountId): array;
}
