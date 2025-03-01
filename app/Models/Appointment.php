<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use HasFactory,
        SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'appointment_date' => 'datetime',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->created_by = \Auth::user()->id;
            $model->status = 'pending';
        });

        static::created(function (Appointment $model) {
            $model->code = 'JT'.now()->format('YmdHis');
            $model->full_name = $model->first_name.' '.$model->last_name;
            $model->save();
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }
}
