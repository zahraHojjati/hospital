<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class Setting extends Model
{
    use HasFactory,HasRoles,LogsActivity;


    protected
        $fillable = [
        'group',
        'label',
        'name',
        'type',
        'value',
    ];
    public function getActivitylogOptions(): LogOptions
    {
        $modelId=$this->attributes['id'];
        $userId=auth()->user()->id;
        $description=" تنظیمات با شناسه {$modelId}توسط کاربر با شناسه {$userId}";
        return LogOptions::defaults()
            ->logFillable()
            ->setDescriptionForEvent(fn(string $eventName) =>$description.' '. __('custom.'.$eventName));
    }

    const GROUP = [
        'general' => 'عمومی',
        'social' => 'شبکه های مجازی'
    ];


//    protected $appends = [
//        'image_url'
//    ];
//
//    protected function imageUrl(): Attribute
//    {
//        return Attribute::make(
//            get: fn () => $this->getImage()
//        );
//    }
//    public function getImage()
//    {
//        return Storage::disk('public')->url($this->attributes['image']);
//    }
    public function value(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => $this->attributes['type'] == 'image' ?
                \Illuminate\Support\Facades\Storage::url($value) :
                $value,
        );
    }
    public static function clearAllCaches()
    {
        if (Cache::has('settings')) {
            Cache::forget('settings');
        }
        if (Cache::has('all_settings')) {
            Cache::forget('all_settings');
        }
    }
    protected static function booted(): void
    {
        static::created(function () {
            static::clearAllCaches();
        });
        static::updated(function () {
            static::clearAllCaches();
        });
        static::deleted(function () {
            static::clearAllCaches();
        });
        static::saved(function () {
            static::clearAllCaches();
        });
    }

}
