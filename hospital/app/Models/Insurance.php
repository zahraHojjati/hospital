<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Activitylog\Traits\LogsActivity;

class Insurance extends Model
{
    use HasFactory , HasRoles , LogsActivity;
    protected $guard_name = 'web';
    protected $fillable=[
      'name',
      'type',
      'discount',
      'status'
    ];
    public function getActivitylogOptions(): LogOptions
    {
        $modelId=$this->attributes['id'];
        $userId=auth()->user()->id;
        $description=" بیمه با شناسه {$modelId}توسط کاربر با شناسه {$userId}";
        return LogOptions::defaults()
            ->logFillable()
            ->setDescriptionForEvent(fn(string $eventName) =>$description.' '. __('custom.'.$eventName));
    }
    public function basicSurgeries(): HasMany
    {
        return $this->hasMany(Surgery::class, 'basic_insurance_id');
    }
    public function suppSurgeries(): HasMany
    {
        return $this->hasMany(Surgery::class, 'supp_insurance_id');
    }

    public function sumSurgeriesTotalPrice($surgeries): int
    {

        $sumTotalPrice = 0;
        foreach ($surgeries as $surgery) {
            $sumTotalPrice += $surgery->getTotalPrice();
        }

        return (int) $sumTotalPrice;
    }

    public function sumSurgeriesInsuranceContribution($surgeries): int
    {
        $sumInsuranceContribution = 0;
        foreach ($surgeries as $surgery) {
            $sumInsuranceContribution += $surgery->getInsuranceContribution();
        }

        return (int) $sumInsuranceContribution;
    }
}
