<?php

namespace App\Http\Controllers;

use App\Http\Requests\CurrencyRate\IndexRequest;
use App\services\CurrencyRateService;
use Illuminate\Pagination\LengthAwarePaginator;

class CurrencyController extends Controller
{
    public function index(
        IndexRequest $request,
        CurrencyRateService $currencyRateService
    ): LengthAwarePaginator {
        return $currencyRateService->getFromDB($request);
    }
}
