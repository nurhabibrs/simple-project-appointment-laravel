<?php

namespace App\Models;

use App\Enums\AppointmentEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use HasFactory,
        SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'appoint_for' => AppointmentEnum::class,
    ];

    protected static function booted()
    {
        static::created(function (Appointment $model) {
            $model->code = 'JT'.now()->format('YmdHis');
            $model->full_name = $model->first_name.' '.$model->last_name;
            $model->save();
        });
    }
}
