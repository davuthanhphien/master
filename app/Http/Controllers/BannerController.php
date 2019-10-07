<?php

namespace App\Http\Controllers;

use App\Repositories\Banner\BannerRepositoryInterface;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BannerController extends Controller
{
    protected $bannerRepository;

    public function __construct(BannerRepositoryInterface $bannerRepository)
    {
        $this->bannerRepository = $bannerRepository;
    }

    function index()
    {
        return view('admin.element.banner.index');
    }

    function getdata()
    {
        $banner = $this->bannerRepository->getAll();
        return DataTables::of($banner)
            ->addColumn('action', function ($banner) {
                return view('admin.element.table.action_banner', ['banner' => $banner])->render();
            })
            ->addColumn('image', function ($banner) {
                return view('admin.element.table.image', ['banner' => $banner])->render();
            })
            ->rawColumns(['image', 'action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.element.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->has('image')){
            $imageName = time().$request->image->getClientOriginalName();
            $this->bannerRepository->handleUploadedImage($request->image,$imageName);
        }
        $this->bannerRepository->create([
            'image' => $imageName,
            'name_vi'=>$request->name_vi,
            'location'=>$request->location,
            'order_no' => $request->order_no]);
        return redirect()->route('banner.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $banner = $this->bannerRepository->getById($id);
       return view('admin.element.banner.edit',compact('banner'));
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
        $this->bannerRepository->update($id,$request->all());
        return redirect()->route('banner.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->bannerRepository->delete($id);
        return back();
    }
}
