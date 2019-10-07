<?php

namespace App\Http\Controllers;

use App\Export\UserExport;
use App\Import\UserImport;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Role;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use function Sodium\compare;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;
use App\Http\Requests\loginRequest;
use App\Http\Requests\registerRequest;
use App\Role_user;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;


class UserController extends Controller
{
    protected $userRepository;
    protected $roleRepository;
    public function __construct(UserRepositoryInterface $userRepository,RoleRepositoryInterface $roleRepository)
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(loginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('admin/dashboard');
        }else{
            return back();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/user/login');
    }

    protected function register(registerRequest $request)
    {
        $request['password'] = Hash::make($request->password);
        $this->userRepository->create($request->all());
        return redirect(route('login'));
    }


    public function showRegistrationForm()
    {
        return view('auth.register');
    }


    function index()
    {
        return view('admin.user.index');
    }

    function getdata()
    {
        $user = $this->userRepository->getAll();
        return DataTables::of($user)
            ->addColumn('action', function ($user) {
                return view('admin.user.table.action', ['user' => $user])->render();
            })
            ->make(true);
    }
    public function create()
    {
        $role = $this->roleRepository->getAll();
        return view('admin.user.create', compact('role'));
    }

    function getdataRole()
    {
        $role = $this->roleRepository->getAll();
        return DataTables::of($role)
            ->addColumn('action', function ($role) {
                return view('admin.user.table.actionCheckbox', compact('role'))->render();
            })
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->checkRole;
        $request['password'] = Hash::make($request->password);
        $user = $this->userRepository->create($request->all());
        $user->role()->attach($input);

        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->userRepository->getById($id);
        return view('admin.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->getById($id);
        $role = $this->roleRepository->getAll();
        $arr_roleId = [];
        foreach ($user->role as $item) {
            array_push($arr_roleId, $item->id);
        }
        return view('admin.user.edit', compact('user', 'arr_roleId', 'role'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $input = $request->checkRole;
        $this->userRepository->update($id, $request->all());
        $this->userRepository->sync($id,$input);
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->userRepository->detach($id);
        $this->userRepository->delete($id);
        return back();
    }

    public function export()
    {
        return Excel::download(new UserExport, 'users.xlsx');
    }
    public function postImport()
    {
        Excel::import(new UserImport, 'users.xlsx');

        return redirect('/');
    }
}
