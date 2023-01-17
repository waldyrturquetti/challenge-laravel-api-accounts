<?php

namespace App\Application\Account\createAccount;

use App\Models\Account;

class CreateAccountCommand
{
    private string $user_name;
    private ?float $credits;
    private int $user_id;
    private string $type;
    private ?string $cnpj;

    /**
     * @param string $user_name
     * @param float|null $credits
     * @param int $user_id
     * @param string $type
     * @param string|null $cnpj
     */
    public function __construct(string $user_name, ?float $credits, int $user_id, string $type, ?string $cnpj)
    {
        $this->user_name = $user_name;
        $this->credits = $credits;
        $this->user_id = $user_id;
        $this->type = $type;
        $this->cnpj = $cnpj;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string|null
     */
    public function getCnpj(): ?string
    {
        return $this->cnpj;
    }

    public function toModel(): Account
    {
        $account = new Account();
        $account->user_name = $this->user_name;
        $account->credits = $this->credits ?? 0.00;
        $account->user_id = $this->user_id;
        $account->type = $this->type;
        $account->cnpj = $this->cnpj;
        $account->active = true;

        return $account;
    }


}
