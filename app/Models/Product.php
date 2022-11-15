<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public $timestamps = false;

    protected $casts = [
        'discount_start' => 'datetime',
        'discount_end' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }


    public function values()
    {
        return $this->belongsToMany(AttributeValue::class);
    }


    public function isDiscount()
    {
        if ($this->discount_percent > 0 and $this->discount_start <= Carbon::now()->toDateTimeString() and $this->discount_end >= Carbon::now()->toDateTimeString()) {
            return true;
        } else {
            return false;
        }
    }


    public function getPrice()
    {
        return round($this->price * (1 - $this->discount_percent / 100), 1);
    }


    public function getName()
    {
        $locale = app()->getLocale();
        switch ($locale) {
            case 'tm':
                return $this->name_tm;
                break;
            case 'en':
                return $this->name_en ?: $this->name_tm;
                break;
            default:
                return $this->name_tm;
        }
    }
}
