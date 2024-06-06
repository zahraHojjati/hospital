<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class OperationSurgery extends Model
{
    use HasFactory , LogsActivity , HasRoles;
    protected $table='operation_surgery';
    protected $fillable=[
      'operation_id',
      'surgery_id',
      'amount'
    ];
    public function getActivitylogOptions(): LogOptions
    {
        $modelId=$this->attributes['id'];
        $userId=auth()->user()->id;
        $description=" عمل جراحی با شناسه {$modelId}توسط کاربر با شناسه {$userId}";
        return LogOptions::defaults()
            ->logFillable()
            ->setDescriptionForEvent(fn(string $eventName) =>$description.' '. __('custom.'.$eventName));
    }
}
