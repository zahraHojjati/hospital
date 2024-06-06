<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class Notification extends Model
{
    use HasFactory , HasRoles, LogsActivity;
    protected $guard_name = 'web';
    protected $fillable=[
        'title',
        'body',
        'viewed_at'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        $modelId = $this->attributes['id'];
        $userId = auth()->check() ? auth()->user()->id : null;
        $description = "  اعلان با شناسه {$modelId}توسط کاربر با شناسه {$userId}";
        return LogOptions::defaults()
            ->logFillable()
            ->setDescriptionForEvent(fn(string $eventName) => $description . ' ' . __('custom.' . $eventName));
    }

}
