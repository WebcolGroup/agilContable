<?php

namespace App\Domain\Accounting\Entities;

class JournalEntry
{
    private string $id;
    private string $accountId;
    private string $description;
    private float $debit;
    private float $credit;
    private \DateTime $date;

    public function __construct(string $id, string $accountId, string $description, float $debit, float $credit, \DateTime $date)
    {
        $this->id = $id;
        $this->accountId = $accountId;
        $this->description = $description;
        $this->debit = $debit;
        $this->credit = $credit;
        $this->date = $date;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getAccountId(): string
    {
        return $this->accountId;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getDebit(): float
    {
        return $this->debit;
    }

    public function getCredit(): float
    {
        return $this->credit;
    }

    public function getDate(): \DateTime
    {
        return $this->date;
    }
}
