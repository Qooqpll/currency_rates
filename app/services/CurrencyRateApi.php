<?php

namespace App\services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Log;
use Throwable;

final class CurrencyRateApi
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => config('services.nbrb.base_uri'),
            'verify' => false,
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    public function getCurrencyRates(int $periodicity = 0): ?array
    {
        try {
            $response = $this->client->get('exrates/rates', [
                'query' => [
                    'periodicity' => $periodicity,
                ],
                'timeout' => 1,
            ])->getBody()->getContents();
        } catch (ClientException $ex) {
            return null;
        } catch (Throwable $ex) {
            Log::error(
                'Ошибка получения данных : ' . json_encode($ex->getMessage(), JSON_UNESCAPED_UNICODE)
            );

            return null;
        }

        return json_decode($response, true);
    }
}
