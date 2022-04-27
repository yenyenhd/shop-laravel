<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Requests\RequestUser;
use Illuminate\Routing\Controller;
use App\Models\User;
use Hash;
use App\Traits\Delete;
use App\Traits\StorageImage;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    use StorageImage;
    use Delete;


    // public function __construct()
    // {
    //     $this->middleware('role:admin');
    // }
    public function index()
    {
        $users = User::all();
        return view('admin::user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin::user.add', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(RequestUser $request)
    {
        $dataInsert = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];
        $dataImage = $this->storageUpload($request, 'image_path', 'user');
        if(!empty($dataImage)){
            $dataInsert['image_path'] = $dataImage['file_path'];
        }
        $user = User::create($dataInsert);
        $data = $request->all();
        $user->assignRole($data['role_id']);

        return redirect('admin/user/create')->with('message', 'Thêm user thành công');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('admin::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        $roleOfUser = $user->roles;
        return view('admin::user.edit', compact('user', 'roles', 'roleOfUser' ));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $dataImage = $this->storageUpload($request, 'image_path', 'user');
            if(!empty($dataImage)){
                $dataUpdate['image_path'] = $dataImage['file_path'];
            }
        $dataUpdate = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];
        User::find($id)->update($dataUpdate);
        $user = User::find($id);
        $data = $request->all();
        $user->syncRoles($data['role_id']);
        return redirect('admin/user')->with('message', 'Update user thành công');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $this->deleteTrait($id, $user);
        return redirect('admin/user');
    }
}
