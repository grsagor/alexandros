<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Event extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = substr(uniqid(), 0, 13).'-stlout-'.random_int(10000000000000000, 99999999999999999);
        });
    }

    protected $fillable = [
        'title',
        'venue_id',
        'max_participent',

        'banner',
        'status',
        'is_free',
        'type_of_event',
        'social_media_links',
        'booking_url',

        'amount',
        'description',
        'discount_type',
        'discount_value',
        'start_datetime',
        'end_datetime',
        'sponsour_min_value',
        'sponsour_max_value'
    ];
}
