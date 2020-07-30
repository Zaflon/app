<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index.listing', [
            'view' => \App\Helpers\Utils::main(Self::class, new \App\Coupon())
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('coupons.create', [
            'view' => \App\Helpers\Utils::important(Self::class, \App\Helpers\Utils::CREATE, (object) [])
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \App\Coupon::create([
            'name' => $request->name,
            'price' => $request->price,
            'detail' => $request->detail
        ]);

        return view('index.listing', [
            'view' => \App\Helpers\Utils::main(Self::class, new \App\Coupon())
        ]);
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
        return view('coupons.edit', [
            'view' => \App\Helpers\Utils::important(
                Self::class,
                \App\Helpers\Utils::EDIT,
                (object) \App\Coupon::find($id)->toArray()
            )
        ]);
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
        \App\Coupon::where('id', $id)->update([
            'name' => $request->name,
            'price' => $request->price,
            'detail' => $request->detail
        ]);

        return view('index.listing', [
            'view' => \App\Helpers\Utils::main(Self::class, new \App\Coupon())
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \App\Coupon::where('id', $id)->delete();

        return \App\Helpers\Utils::JSONDestroyArray(true, $id, 'Coupon');
    }
}
