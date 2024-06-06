<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;


class Invoice extends Model
{
    use HasFactory, HasRoles, LogsActivity;

    protected $guard_name = 'web';
    protected $fillable = [
        'doctor_id',
        'amount',
        'description',
        'status'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        $modelId = $this->attributes['id'];
        $userId = auth()->user()->id;
        $description = " صورت حساب با شناسه {$modelId}توسط کاربر با شناسه {$userId}";
        return LogOptions::defaults()
            ->logFillable()
            ->setDescriptionForEvent(fn(string $eventName) => $description . ' ' . __('custom.' . $eventName));
    }

    public function createdAt()
    {
        return verta($this->attributes['created_at'])->format('Y/m/d');
    }


    public function surgeries(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(DoctorSurgery::class, 'invoice_id');
    }

    public function doctor():BelongsTo
    {
        return $this->belongsTo(Doctor::class,'doctor_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'invoice_id');
    }

    public function getSumPaymentAmount():int
    {
        return (int) $this->payments->where('status',1)->sum('amount');
    }
    public function getRemainingAmount():int
    {
        return (int) $this->attributes['amount'] - $this->getSumPaymentAmount();
    }

}
