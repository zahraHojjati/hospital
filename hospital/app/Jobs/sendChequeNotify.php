<?php

namespace App\Jobs;

use App\Models\Notification;
use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;

class sendChequeNotify implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {

    }

    public function handle(): void
    {
        $cheques = Payment::query()
            ->where('pay_type', '=','cheque')
            ->where('due_date', '<=', Carbon::now()->addDays(3))
            ->where('status','=',1)
//            ->whereNull('notified_at')
            ->where('notified_at', '=' ,null)
            ->get();
        foreach ($cheques as $cheque)
        {
            Notification::create([
                'title' => "موعد پرداخت چک با شناسه $cheque->id",
                'body' => "چک با شناسه پرداخت $cheque->id در تاریخ $cheque->due_date تاریخ سررسید آن است  ",
                'viewed_at' => null,
            ]);
            $cheque->update([
                'notified_at'=>now()
            ]);
        }
    }
}
