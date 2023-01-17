<?php

namespace App\Application\Account\createAccount;

use App\Models\Account;

class MapperAccountToSchema
{
    private int $id;
    private string $user_name;
    private float $credits;
    private int $user_id;
    private string $type;
    private ?string $cnpj;
    private bool $active;

    /**
     * @param Account $account
     *
     * @return void
     */
    public function __construct(Account $account)
    {
        $this->id = $account->id;
        $this->user_name = $account->user_name;
        $this->credits = $account->credits;
        $this->user_id = $account->user_id;
        $this->type = $account->type;
        $this->cnpj = $account->cnpj;
        $this->active = $account->active;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'user_name' => $this->user_name,
            'credits' => $this->credits,
            'user_id' => $this->user_id,
            'type' => $this->type,
            'cnpj' => $this->cnpj,
            'active' => $this->active,
        ];
    }
}
