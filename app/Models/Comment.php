<?php

namespace App\Models;
/* Imports */
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comments',
        'customer_id',
        'reservation_place_id',
    
    ];
    
    
    
    protected $dates = [
            'created_at',
        'updated_at',
    ];

    protected $appends = ["api_route", "can"];

    /* ************************ ACCESSOR ************************* */

    public function getApiRouteAttribute() {
        return route("api.comments.index");
    }
    public function getCanAttribute() {
        return [
            "view" => \Auth::check() && \Auth::user()->can("view", $this),
            "update" => \Auth::check() && \Auth::user()->can("update", $this),
            "delete" => \Auth::check() && \Auth::user()->can("delete", $this),
            "restore" => \Auth::check() && \Auth::user()->can("restore", $this),
            "forceDelete" => \Auth::check() && \Auth::user()->can("forceDelete", $this),
        ];
    }

    protected function serializeDate(DateTimeInterface $date) {
        return $date->format('Y-m-d H:i:s');
    }

    /* ************************ RELATIONS ************************ */
    /**
    * Many to One Relationship to \App\Models\Customer::class
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function customer() {
        return $this->belongsTo(\App\Models\Customer::class,"customer_id","id");
    }
    /**
    * Many to One Relationship to \App\Models\ReservationPlace::class
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function reservationPlace() {
        return $this->belongsTo(\App\Models\ReservationPlace::class,"reservation_place_id","id");
    }
}
