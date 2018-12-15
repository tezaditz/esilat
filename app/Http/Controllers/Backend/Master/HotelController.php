<?php

namespace App\Http\Controllers\Backend\Master;

use App\Models\Backend\Master\Hotel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hotels = Hotel::orderBy('created_at', 'desc')->paginate(10);

        return view('backend.master.hotel.index', ['hotels' => $hotels]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), Hotel::rules());

        if($validator->fails())
        {
            return redirect()->route('master.hotel.index')->withErrors($validator)->withInput();
        }

        $hotel = new Hotel();

        $hotel->nama_hotel      = $request->nama_hotel;
        $hotel->nama_perusahaan = $request->nama_perusahaan;
        $hotel->ktp             = $request->ktp;
        $hotel->npwp            = $request->npwp;
        $hotel->nama_bank       = $request->nama_bank;
        $hotel->no_rekening     = $request->no_rekening;

        $hotel->save();

        \Session::flash('success', trans('backend/master/hotel.hotel.store.messages.success'));

        return redirect()->route('master.hotel.index')->withInput();
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
        //
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
        $validator = \Validator::make($request->all(), Hotel::rules());

        if($validator->fails())
        {
            return redirect()->route('master.hotel.index')->withErrors($validator)->withInput();
        }

        $hotel = Hotel::find($id);

        $hotel->nama_hotel      = $request->nama_hotel;
        $hotel->nama_perusahaan = $request->nama_perusahaan;
        $hotel->ktp             = $request->ktp;
        $hotel->npwp            = $request->npwp;
        $hotel->nama_bank       = $request->nama_bank;
        $hotel->no_rekening     = $request->no_rekening;

        $hotel->save();

        \Session::flash('success', trans('backend/master/hotel.hotel.update.messages.success'));

        return redirect()->route('master.hotel.index')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (is_null($id)) {
            \Session::flash('info', trans('backend/master/hotel.hotel.destroy.messages.info'));

            return redirect()->route('master.hotel.index');
        }

        Hotel::destroy($id);
        \Session::flash('success', trans('backend/master/hotel.hotel.destroy.messages.success'));

        return redirect()->route('master.hotel.index');
    }

    public function search(Request $request)
    {
        $hotels = Hotel::orderBy('created_at', 'desc')
            ->where($request->options,'like', '%' . $request->search . '%')
            ->paginate(10);

        return view('backend.master.hotel.index', ['hotels' => $hotels]);
    }
}
