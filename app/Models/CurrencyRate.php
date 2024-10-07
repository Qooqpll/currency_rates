<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int currency_id
 * @property Carbon $date
 * @property string abbreviation
 * @property int $scale
 * @property string $name
 * @property float rate
 */
class CurrencyRate extends Model
{
    use HasFactory;
}
