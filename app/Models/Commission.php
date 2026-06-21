<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    protected $fillable = [
        'address',
        'phone',
        'extension_phone',
        'email',
        'budget_from',
        'budget_to',
        'commerce_from',
        'commerce_to',
        'route',
        'schedule',
    ];
    protected $casts = [
        'budget_from'   => 'date',
        'budget_to'     => 'date',
        'commerce_from' => 'date',
        'commerce_to'   => 'date',
        'schedule'      => 'array',
    ];
    protected function formattedPhone(): Attribute
    {
        return Attribute::make(
            get: function () {
                $digits = preg_replace('/\D/', '', (string) $this->phone);
                if (strlen($digits) === 11) {
                    return sprintf(
                        '8 (%s) %s-%s-%s',
                        substr($digits, 1, 3),
                        substr($digits, 4, 3),
                        substr($digits, 7, 2),
                        substr($digits, 9, 2),
                    );
                }
                return $this->phone;
            },
        );
    }
}
