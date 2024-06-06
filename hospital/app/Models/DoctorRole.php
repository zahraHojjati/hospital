<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class DoctorRole extends Model
{
    use HasFactory, HasRoles,LogsActivity;

    protected $guard_name = 'web';
    protected $fillable = [
        'title',
        'required',
        'quota',
        'status'
    ];
    public function getActivitylogOptions(): LogOptions
    {
        $modelId=$this->attributes['id'];
        $userId=auth()->user()->id;
        $description=" نقش دکتر با شناسه {$modelId}توسط کاربر با شناسه {$userId}";
        return LogOptions::defaults()
            ->logFillable()
            ->setDescriptionForEvent(fn(string $eventName) =>$description.' '. __('custom.'.$eventName));
    }



    public function doctors():BelongsToMany
    {
        return $this->belongsToMany(Doctor::class , 'doctor_doctor_role');
    }
}
