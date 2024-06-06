<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class DoctorSurgery extends Model
{
    public $timestamps = false;
    use HasFactory,LogsActivity;
    protected $table='doctor_surgery';
    protected $fillable=[
      'doctor_id',
      'surgery_id',
      'doctor_role_id',
      'invoice_id',
        'amount'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        $modelId=$this->attributes['id'];
        $userId=auth()->user()->id;
        $description=" پزشک جراح با شناسه {$modelId}توسط کاربر با شناسه {$userId}";
        return LogOptions::defaults()
            ->logFillable()
            ->setDescriptionForEvent(fn(string $eventName) =>$description.' '. __('custom.'.$eventName));
    }
//public function getTotalPrice()
//{
//    $this->surgery->getTotalPrice();
//}
    public function getDoctorQuotaAmount():int
    {
return round(($this->doctorRole->quota/100) * $this->surgery->getTotalPrice()) ;
    }


    public function doctor():BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }
    public function surgery(): BelongsTo
    {
        return $this->belongsTo(Surgery::class);
    }

public function doctorRole():BelongsTo
{
    return $this->belongsTo(DoctorRole::class,'doctor_role_id');
}

    public function invoice(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }

    public function getDoctorAmount(): int
    {
        $totalPrice = $this->surgery->getTotalPrice();
        $quota = $this->doctorRole->quota;

        return round(($totalPrice * $quota) / 100);
    }

}
