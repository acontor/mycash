<?php

namespace App\Http\Requests;

use App\Interfaces\AccountRepositoryInterface;
use Illuminate\Foundation\Http\FormRequest;

class StoreGoalRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(AccountRepositoryInterface $accountRepository): bool
    {
        $account = $accountRepository->getAccountById($this->account_id);
    
        return $this->user()->can('viewObjetivos', $account);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'account_id'  => 'required|exists:accounts,id',
            'amount'      => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'contributed' => 'nullable|numeric',
            'description' => 'nullable|string|max:255',
            'end_date'    => 'required|date',
            'name'        => 'required|string|max:255',
            'spent'       => 'nullable|numeric',
        ];
    }
}
