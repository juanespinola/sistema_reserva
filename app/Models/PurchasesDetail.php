<?php

namespace App\Models;
/* Imports */
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasesDetail extends Model
{
    use HasFactory;
protected $table = 'purchases_detail';
    
    protected $fillable = [
        'quantity',
        'total_amount',
        'purchase_id',
        'product_id',
    
    ];
    
    
    
    protected $dates = [
            'created_at',
        'updated_at',
    ];

    protected $appends = ["api_route", "can"];

    /* ************************ ACCESSOR ************************* */

    public function getApiRouteAttribute() {
        return route("api.purchases-details.index");
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
    * Many to One Relationship to \App\Models\Product::class
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function product() {
        return $this->belongsTo(\App\Models\Product::class,"product_id","id");
    }
    /**
    * Many to One Relationship to \App\Models\Purchase::class
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function purchase() {
        return $this->belongsTo(\App\Models\Purchase::class,"purchase_id","id");
    }
}
