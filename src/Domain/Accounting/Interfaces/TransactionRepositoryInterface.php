<?php

namespace App\Domain\Accounting\Interfaces;

use App\Domain\Accounting\Entities\Transaction;

interface TransactionRepositoryInterface
{
    public function save(Transaction $transaction): void;
    public function findByAccountId(string $accountId): array;
}
