<?php

namespace App\Http\Requests\CurrencyRate;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $date
 */
class IndexRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'date' => ['nullable', 'date', 'date_format:Y-m-d']
        ];
    }
}
