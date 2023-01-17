<?php

namespace App\Application\Account\createAccount;

use App\Exceptions\ConflictException;
use App\Models\Account;
use App\Repository\AccountRepositoryInterface;

class CreateAccountHandler
{
    private AccountRepositoryInterface $accountRepository;

    /**
     * @param AccountRepositoryInterface $accountRepository
     */
    public function __construct(AccountRepositoryInterface $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }

    /**
     * @throws ConflictException
     */
    public function handle(CreateAccountCommand $createAccountCommand): MapperAccountToSchema
    {
        if (is_null($createAccountCommand->getCnpj()) && $createAccountCommand->getType() == Account::BUSINESS_ACCOUNT) {
            throw new ConflictException('For this account type is need the CNPJ');
        }

        if (!is_null($createAccountCommand->getCnpj()) && $createAccountCommand->getType() == Account::PERSONAL_ACCOUNT) {
            throw new ConflictException("For this account type isn't need the CNPJ.");
        }

        if (!is_null($createAccountCommand->getCnpj())) {
            if ($this->accountRepository->existsAccountByCnpj($createAccountCommand->getCnpj())) {
                throw new ConflictException('This CNPJ already use by other account.');
            }
        }

        $account = $this->accountRepository->createAccount($createAccountCommand->toModel());

        return new MapperAccountToSchema($account);
    }
}
