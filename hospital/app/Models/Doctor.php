<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use PhpParser\Node\Expr\Cast\Bool_;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class Doctor extends Authenticatable
{
    use HasFactory, HasRoles, LogsActivity,HasApiTokens;

    protected $fillable = [
        'name',
        'speciality_id',
        'national_code',
        'medical_number',
        'mobile',
        'password',
        'email',
        'status'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        $modelId = $this->attributes['id'];
        $userId = auth()->user()->id;
        $description = " دکتر با شناسه {$modelId}توسط کاربر با شناسه {$userId}";
        return LogOptions::defaults()
            ->logFillable()
            ->setDescriptionForEvent(fn(string $eventName) => $description . ' ' . __('custom.' . $eventName));
    }
    public function attachRoles(?array $roleNames, $onUpdate = false)
    {
        if($roleNames != null) {
            $roleIds = [];

            foreach ($roleNames as $roleName) {
                $role = DoctorRole::firstOrCreate(['title' => $roleName]);

                $roleIds[] = $role->id;

                if($onUpdate == true) {
                    $this->doctorRoles()->sync($roleIds);
                } else {
                    $this->doctorRoles()->attach($role->id);
                }
            }
        }
    }

    public function speciality(): BelongsTo
    {
        return $this->belongsTo(Speciality::class, 'speciality_id');
    }

    public function doctorRoles(): BelongsToMany
    {
        return $this->belongsToMany(DoctorRole::class, 'doctor_doctor_role');
    }

    public function surgeries():BelongsToMany
    {
        return $this->belongsToMany(Surgery::class)->withPivot(['doctor_role_id', 'invoice_id', 'amount']);

    }

    public function invoice(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    public function payments(): HasManyThrough
    {
        return $this->hasManyThrough(Payment::class, Invoice::class);
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
