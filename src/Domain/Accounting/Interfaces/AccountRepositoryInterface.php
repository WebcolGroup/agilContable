<?php

namespace App\Domain\Accounting\Interfaces;

use App\Domain\Accounting\Entities\Account;

interface AccountRepositoryInterface
{
    public function save(Account $account): void;
    public function findById(string $id): ?Account;
}
