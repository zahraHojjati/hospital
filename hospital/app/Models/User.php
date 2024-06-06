<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles , LogsActivity;
//protected $routeMiddleware;
 protected $table='users';
    protected $fillable = [
        'name',
        'mobile',
        'email',
        'password',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        $modelId=$this->attributes['id'];
        $userId=auth()->user()->id;
        $description=" کاربر با شناسه {$modelId}توسط کاربر با شناسه {$userId}";
        return LogOptions::defaults()
            ->logFillable()
            ->setDescriptionForEvent(fn(string $eventName) =>$description.' '.__('custom.'.$eventName));
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

//    public function getActivitylogOptions(): LogOptions
//    {
//        return LogOptions::defaults()
//            ->logOnly(['name', 'mobile','email','password']);
//        // Chain fluent methods for configuration options
//    }
}
