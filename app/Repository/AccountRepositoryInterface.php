<?php

namespace App\Repository;

use App\Models\Account;

interface AccountRepositoryInterface
{
    public function createAccount(Account $account): Account;
    public function existsAccountByCnpj(string $cnpj): bool;
    public function existsAccountByUserAndType(int $userId, string $type): bool;
}
