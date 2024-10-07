<?php

namespace App\Console\Commands;

use App\Models\CurrencyRate;
use App\services\CurrencyRateApi;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ParseCurrencyRate extends Command
{
    protected $signature = 'parse-currency-rates';

    protected $description = 'Получения официального курса белорусского рубля по отношению к иностранным валютам';

    public function handle(CurrencyRateApi $currencyRateApi): void
    {
        $rates = $currencyRateApi->getCurrencyRates();

        DB::transaction(function () use ($rates) {
            foreach ($rates as $rate) {
                CurrencyRate::query()->updateOrInsert(
                    ['currency_id' => $rate['Cur_ID'], 'date' => $rate['Date']],
                    [
                        'currency_id' => $rate['Cur_ID'],
                        'date' => $rate['Date'],
                        'Abbreviation' => $rate['Cur_Abbreviation'],
                        'scale' => $rate['Cur_Scale'],
                        'name' => $rate['Cur_Name'],
                        'rate' => $rate['Cur_OfficialRate']
                    ]
                );
            }
        });

        $this->info('импорт данных завершён успешно');
    }
}
