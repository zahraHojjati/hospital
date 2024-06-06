<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Surgery extends Model
{
    use HasFactory , HasRoles,LogsActivity;
    protected $guard_name = 'web';
    protected $fillable=[
      'patient_name',
      'patient_national_code',
      'basic_insurance_id',
      'supp_insurance_id',
      'document_number',
      'description',
      'surgeried_at',
      'released_at'
    ];
    public function getActivitylogOptions(): LogOptions
    {
        $modelId=$this->attributes['id'];
        $userId=auth()->user()->id;
        $description=" جراحی با شناسه {$modelId}توسط کاربر با شناسه {$userId}";
        return LogOptions::defaults()
            ->logFillable()
            ->setDescriptionForEvent(fn(string $eventName) =>$description.' '. __('custom.'.$eventName));
    }

    public function getTotalPrice(): int
    {
        return (int) $this->operations->sum('pivot.amount');
    }

    public function getDoctorQuotaAmount(DoctorRole $doctorRole): int
    {
        return round(((int) $doctorRole->quota / 100) * $this->getTotalPrice());
    }
    public function operations(): BelongsToMany
    {
        return $this->belongsToMany(Operation::class, 'operation_surgery')
            ->withPivot(['amount']);
    }

    public function doctors():BelongsToMany
    {
        return $this->belongsToMany(Doctor::class, 'doctor_surgery')
            ->withPivot(['doctor_role_id','invoice_id','amount']);
    }

    public function doctorSurgeries(): HasMany
    {
        return $this->hasMany(DoctorSurgery::class);
    }
    public function basicInsurance():BelongsTo
    {
        return $this->belongsTo(Insurance::class,'basic_insurance_id');
    }
    public function suppInsurance():BelongsTo
    {
        return $this->belongsTo(Insurance::class,'supp_insurance_id');
    }


    public function getDoctorAmount($doctorRoleId): int
    {
        $doctorRole = DoctorRole::findOrFail($doctorRoleId);
        return (int) round(($doctorRole->quota / 100) * $this->getTotalPrice());
    }

    public function getInsuranceContribution(): int
    {
        $insurance = $this->basicInsurance ?: $this->suppInsurance;

        return (int) round($this->getTotalPrice() * $insurance->discount / 100);
    }

}
