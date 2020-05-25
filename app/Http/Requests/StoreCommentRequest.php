<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\HasWalletFunds;

class StoreCommentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'content' => 'required|min:10',
            'coinsAmount' => [
                'sometimes',
                'required',
                'numeric',
                new HasWalletFunds($this->user()),
            ],
        ];
    }
}
