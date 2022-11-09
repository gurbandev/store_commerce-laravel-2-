<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $guarded = [
        'id',
    ];

    public $timestamps = false;


    public function getImage()
    {
        $locale = app()->getLocale();
        switch ($locale) {
            case 'tm':
                return $this->image_tm;
                break;
            case 'en':
                return $this->image_en ?: $this->image_tm;
                break;
            default:
                return $this->image_tm;
        }
    }
}
