<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\operationStoreRequest;
use App\Http\Requests\Admin\operationUpdateRequest;
use App\Models\Operation;
use App\Models\User;
use Faker\Provider\Biased;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Collection;

class OperationController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:view operations')->only('index');
        $this->middleware('can:create operations')->only('create');
        $this->middleware('can:update operations')->only('update');
        $this->middleware('can:delete operations')->only('delete');
    }
    public function index()
    {
        $name = request('name');
        $status = request('status') !== 'all' ? request('status') : null;
        $startedDate = request('started_date');
        $finishedDate = request('finished_date');
        $operations = Operation::query()
            ->select(['id', 'name', 'status', 'price', 'created_at'])
            ->when($name, function (Builder $query) use ($name) {
                return $query->where('name', 'like' ,"%{$name}%");
            })
            ->when(isset($status), function (Builder $query) use ($status) {
                return $query->where('status', $status);
            })
            ->when($startedDate, function (Builder $query) use ($startedDate) {
                return $query->where('created_at', '>=', $startedDate);
            })
            ->when($finishedDate, function (Builder $query) use ($finishedDate) {
                return $query->where('created_at', '<=', $finishedDate);
            })
            ->latest('id')
            ->paginate(15)
            ->withQueryString()
        ;

        $operationsCount = $operations->total();


        return view('admin.operation.index', compact(['operationsCount','operations']));
    }

    public function create()
    {
        $permissions = Permission::query()->select(['id', 'label'])->get();
        return view('admin.operation.create', compact('permissions'));
    }

    public function store(operationStoreRequest $request)
    {
         Operation::create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'status' => (bool)$request->input('status')
        ]);

        toastr()->success('عمل جدید با موفقیت ثبت شد');
        return redirect()->route('admin.operations.index');
    }

    public function edit(Operation $operation)
    {
        return view('admin.operation.edit', compact('operation'));
    }

    public function update(operationUpdateRequest $request, Operation $operation)
    {
        $operation->update([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'status' => (bool)$request->input('status')
        ]);

        toastr()->success('عمل با موفقیت ویرایش شد');
        return redirect()->route('admin.operations.index');
    }

    public function destroy(Operation $operation)
    {
        $operation->delete();
        toastr()->success('عمل با موفقیت حذف شد');
        return redirect()->route('admin.operations.index');
    }
}
