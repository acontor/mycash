<?php

namespace App\Http\Requests;

use App\Interfaces\AccountRepositoryInterface;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRecurringTransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(AccountRepositoryInterface $accountRepository): bool
    {
        $account = $accountRepository->getAccountById($this->account_id);

        return $this->user()->can('update', $this->recurring_transaction) && $this->user()->can('viewNormal', $account);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|string|max:255',
            'amount'      => 'required|numeric',
            'description' => 'nullable|string|max:255',
        ];
    }
}
