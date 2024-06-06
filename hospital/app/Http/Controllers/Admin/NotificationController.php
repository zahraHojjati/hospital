<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:view notifications')->only('index');
        $this->middleware('can:show notifications')->only('show');
    }
    public function index()
    {
        $notifications = Notification::query()
            ->select(['id','title','body','viewed_at'])
            ->orderByDesc('id')
            ->paginate(15);
//            ->get();
        $notificationsCount = $notifications->total();

        return view('admin.notification.index', compact('notifications','notificationsCount'));
    }

    public function show(Notification $notification)
    {
        if ($notification->viewed_at == null){
            $notification->update([
                'viewed_at' => now()
            ]);
            return view('admin.notification.show',compact('notification'));
        }
//        if (is_null($notification->viewed_at)) {

        }
        //update

//        Event::dispatch($notification);
//    }
}
