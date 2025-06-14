<?php

namespace App\Application\Accounting\DTO;

class JournalEntryDTO
{
    public string $accountId;
    public string $description;
    public float $debit;
    public float $credit;

    public function __construct(string $accountId, string $description, float $debit, float $credit)
    {
        $this->accountId = $accountId;
        $this->description = $description;
        $this->debit = $debit;
        $this->credit = $credit;
    }
}
