<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Menu\MenuRepositoryInterface;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    protected $menuRepository;
    public function __construct(MenuRepositoryInterface $menuRepository)
    {
        $this->menuRepository = $menuRepository;
    }


    function index()
    {
        return view('admin.element.menu.index');
    }

    function getdata()
    {
        $menu = $this->menuRepository->getAll();
        return DataTables::of($menu)
            ->addColumn('action', function ($menu) {
                return view('admin.element.table.action_menu', ['menu' => $menu])->render();
            })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.element.menu.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['url'] = Str::slug($request->name_vi,'-');
        $this->menuRepository->create($request->all());
        return redirect()->route('menu.index');
    }

    public function edit($id)
    {
        $menu = $this->menuRepository->getById($id);
        return view('admin.element.menu.edit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->menuRepository->update($id,$request->all());
        return redirect()->route('menu.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->menuRepository->delete($id);
        return back();
    }
}
