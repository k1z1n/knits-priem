<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;


class Teacher extends Model
{
    protected $fillable = [
        'surname',
        'name',
        'patronymic',
        'job_title',
        'cabinet',
        'phone',
        'extension_phone',
        'email',
        'image'
    ];

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn () => trim("{$this->surname} {$this->name} {$this->patronymic}"),
        );
    }

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

    public function headOfDepartment()
    {
        return $this->hasOne(Department::class, 'head_id');
    }
}
