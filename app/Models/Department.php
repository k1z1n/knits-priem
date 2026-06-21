<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'title',
        'head_id',
        'is_universal',
    ];

    protected $casts = [
        'is_universal' => 'boolean',
    ];

    public function head()
    {
        return $this->belongsTo(Teacher::class, 'head_id');
    }

    public function specialties()
    {
        return $this->hasMany(Specialty::class);
    }
}
