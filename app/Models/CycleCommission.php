<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CycleCommission extends Model
{
    protected $fillable = [
        'title',
        'chairman_id',
    ];

    public function head(): BelongsTo
    {
        return $this->belongsTo(Teacher::class, 'chairman_id');
    }

    public function specialties()
    {
        return $this->hasMany(Specialty::class);
    }
}
