<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class Payment extends Model
{
    use HasFactory, HasRoles, LogsActivity;

    protected $guard_name = 'web';
    protected $table='payments';
    protected $fillable = [
        'invoice_id',
        'amount',
        'pay_type',
        'due_date',
        'receipt',
        'description',
        'notified_at',
        'status'
    ];



    public function getActivitylogOptions(): LogOptions
    {
        $modelId = $this->attributes['id'];
        $userId = auth()->check() ? auth()->user()->id : null;
        $description = " پرداخت با شناسه {$modelId}توسط کاربر با شناسه {$userId}";
        return LogOptions::defaults()
            ->logFillable()
            ->setDescriptionForEvent(fn(string $eventName) => $description . ' ' . __('custom.' . $eventName));
    }

    protected function imageUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getImage()
        );
    }
    public function getImage()
    {
        return Storage::disk('public')->url($this->attributes['receipt']);
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'amount' => str_replace(',', '', $this->input('amount'))
        ]);
    }

    public function getPaymentType(): string
    {
        return $this->attributes['pay_type'] == 'cash' ? 'نقد' : 'چک';
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }
}
