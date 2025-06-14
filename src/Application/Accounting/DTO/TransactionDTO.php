<?php

namespace App\Application\Accounting\DTO;

class TransactionDTO
{
    public string $accountId;
    public float $amount;
    public string $type;

    public function __construct(string $accountId, float $amount, string $type)
    {
        $this->accountId = $accountId;
        $this->amount = $amount;
        $this->type = $type;
    }
}
