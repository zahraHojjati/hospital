<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class LogActivityController extends Controller
{
    public function index()
    {
        $logs=Activity::query()
            ->select([
               'description',
               'created_at'
            ])
            ->latest('id')
            ->paginate(50)
            ->withQueryString();
        $logsCount=$logs->total();
        $breadcrumbItems=[
            ['title'=>'لیست فعالیت ها','link'=>''],
        ];

        return view('admin.activity.index',compact('logs','logsCount','breadcrumbItems'));
    }
}
