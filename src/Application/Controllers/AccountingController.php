<?php

namespace App\Application\Controllers;

use App\Application\Accounting\DTO\TransactionDTO;
use App\Application\Accounting\UseCases\RegisterTransaction;
use App\Infrastructure\Accounting\Repositories\TransactionRepository;
use App\Infrastructure\Accounting\Repositories\AccountRepository;

class AccountingController
{
    private RegisterTransaction $registerTransaction;

    public function __construct()
    {
        $transactionRepository = new TransactionRepository();
        $accountRepository = new AccountRepository();
        $this->registerTransaction = new RegisterTransaction($transactionRepository, $accountRepository);
    }

    public function registerTransaction(array $data): void
    {
        $transactionDTO = new TransactionDTO(
            $data['accountId'],
            $data['amount'],
            $data['type']
        );

        $this->registerTransaction->execute($transactionDTO);

        echo json_encode(['message' => 'Transaction registered successfully']);
    }
}
