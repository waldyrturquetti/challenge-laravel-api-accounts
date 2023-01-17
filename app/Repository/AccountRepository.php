<?php

namespace App\Repository;

use App\Models\Account;

class AccountRepository implements AccountRepositoryInterface
{
    public function createAccount(Account $account): Account
    {
        $account->save();
        return $account;
    }

    public function existsAccountByCnpj(string $cnpj): bool
    {
        return Account::query()->where('cnpj', $cnpj)->exists();
    }

    public function existsAccountByUserAndType(int $userId, string $type): bool
    {
        return Account::query()
            ->where('user_id', $userId)
            ->where('type', $type)
            ->exists();
    }
}
