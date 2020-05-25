<?php

namespace App\Rules;

use App\User;
use Illuminate\Contracts\Validation\Rule;

class HasWalletFunds implements Rule
{
    protected $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    public function passes($attribute, $value)
    {
        return $this->user->wallet->balance >= $value;
    }

    public function message()
    {
        return 'You don\'t have enough funds.';
    }
}
