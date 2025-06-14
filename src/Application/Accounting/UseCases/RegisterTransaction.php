<?php

namespace App\Application\Accounting\UseCases;

use App\Application\Accounting\DTO\TransactionDTO;
use App\Domain\Accounting\Entities\Transaction;
use App\Domain\Accounting\Interfaces\TransactionRepositoryInterface;
use App\Domain\Accounting\Interfaces\AccountRepositoryInterface;

class RegisterTransaction
{
    private TransactionRepositoryInterface $transactionRepository;
    private AccountRepositoryInterface $accountRepository;

    public function __construct(TransactionRepositoryInterface $transactionRepository, AccountRepositoryInterface $accountRepository)
    {
        $this->transactionRepository = $transactionRepository;
        $this->accountRepository = $accountRepository;
    }

    public function execute(TransactionDTO $transactionDTO): void
    {
        $account = $this->accountRepository->findById($transactionDTO->accountId);

        if (!$account) {
            throw new \Exception("Account with ID {$transactionDTO->accountId} does not exist.");
        }

        $transaction = new Transaction(
            uniqid(),
            $transactionDTO->accountId,
            $transactionDTO->amount,
            $transactionDTO->type,
            new \DateTime()
        );

        $this->transactionRepository->save($transaction);
    }
}
