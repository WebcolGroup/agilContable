<?php

namespace App\Domain\Accounting\Entities;

class Transaction
{
    private string $id;
    private string $accountId;
    private float $amount;
    private string $type;
    private \DateTime $date;

    public function __construct(string $id, string $accountId, float $amount, string $type, \DateTime $date)
    {
        $this->id = $id;
        $this->accountId = $accountId;
        $this->amount = $amount;
        $this->type = $type;
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

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getDate(): \DateTime
    {
        return $this->date;
    }
}
