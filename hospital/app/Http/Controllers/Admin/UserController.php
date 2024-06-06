<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\userStoreRequest;
use App\Http\Requests\Admin\userUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Hekmatinasser\Verta\Verta;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{

    public function index()
    {
        $users = User::select('id', 'mobile','name', 'email', 'created_at', 'status')
            ->where('id','!=',auth()->user()->id)
            ->latest('id')
            ->paginate();
        return view('admin.user.index', compact('users'));
    }


    public function create()
    {
        $permissions = Permission::query()->select('id','label')->get();
        return view('admin.user.create', compact('permissions'));
    }


    public function store(userStoreRequest $request)
    {
//        dd($request->input('permissions'));
        $user = User::create([
            'name' => $request->input('name'),
            'mobile' => $request->input('mobile'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole('admin');
        $permissions = $request->input('permissions');
        if ($permissions!=null){
            $permissions =[];
            foreach ($request->permissions as $permission){
                $permission=Permission::findOrFail($permission);
                $permissions[]=$permission->name;
            }
            $user->givePermissionTo($permission);
        }
        toastr()->success('ادمین جدید با موفقیت ثبت شد');
return redirect()->route('admin.users.index');
    }


    public function edit(User $user)
    {
        $permissions = Permission::select(['id','label'])->get();
        return view('admin.user.edit', compact(['user','permissions']));
    }


    public function update(userUpdateRequest $request, User $user)
    {
        $inputs = [
            'name' => $request->input('name'),
            'mobile' => $request->input('mobile'),
            'email' => $request->input('email'),
        ];
        if ($request->filled('password')) {
            $inputs['password'] = Hash::make($request->password);
        }
        $user->update($inputs);

        if ($request->permissions) {
            $permissions = [];
            foreach ($request->permissions as $permission) {
                $permission = Permission::findOrFail($permission);
                $permissions[] = $permission->name;
            }
            $user->syncPermissions($permissions);
            //$permission->syncRoles($user);
        }
        toastr()->success('ادمین با موفقیت ویرایش شد');
        return redirect()->route('admin.users.index');
    }



 public function destroy(User $user)
 {
//     $user->permission()->delete();
//     $user->role()->delete();
     $user->delete();
     toastr()->success('ادمین با موفقیت حذف شد');
     return redirect()->route('admin.users.index');
 }

}
