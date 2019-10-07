<?php

namespace App\Http\Controllers;

use App\Repositories\Widgets\WidgetsRepositoryInterface;
use App\Widgets;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class WidgetsController extends Controller
{
    protected $widgetsRepository;
    public function __construct(WidgetsRepositoryInterface $widgetsRepository)
    {
        $this->widgetsRepository = $widgetsRepository;
    }

    function index()
    {
        return view('admin.element.widgets.index');
    }

    function getdata()
    {
        $widgets = $this->widgetsRepository->getAll();
        return DataTables::of($widgets)
            ->addColumn('action', function ($widgets) {
                return view('admin.element.table.action_widget', ['widgets' => $widgets])->render();
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
        return view('admin.element.widgets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->widgetsRepository->create($request->all());
        return redirect()->route('widgets.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $widgets = $this->widgetsRepository->getById($id);
        return view('admin.element.widgets.edit',compact('widgets'));
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
        $this->widgetsRepository->update($id,$request->all());
        return redirect()->route('widgets.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->widgetsRepository->delete($id);
        return back();
    }
}
