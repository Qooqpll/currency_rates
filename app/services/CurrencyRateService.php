<?php

namespace App\services;

use App\Http\Requests\CurrencyRate\IndexRequest;
use App\Models\CurrencyRate;
use Illuminate\Pagination\LengthAwarePaginator;

class CurrencyRateService
{
    public function getFromDB(IndexRequest $request): LengthAwarePaginator
    {
        return CurrencyRate::query()
            ->when($request->date, function($query) use ($request) {
                $query->where('date', '=', $request->date);
            })
            ->paginate(100);
    }
}
