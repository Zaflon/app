<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * https://dcgamer.dooca.store/carrinho
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index.listing', [
            'view' => \App\Helpers\Utils::main(Self::class, new \App\Product())
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create', [
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
        $rules =  [
            "brand_id" => "required|integer",
            "name" => "required|max:32",
            "info" => "required",
            "detail" => "required"
        ];

        $messages = [
            "brand_id.integer" => "O código da marca deve ser inteiro",
            "name.max" => "O nome não pode ser maior que 32 caracteres"
        ];

        $request->validate($rules, $messages);

        $id = \App\Brand::find($request->brand_id)->id;

        $Product = new \App\Product();

        $Product->brand_id = (int) $id;
        $Product->name = (string) $request->name;
        $Product->detail = (string) $request->detail;
        $Product->weight = (int) $request->weight;

        $Product->save();

        return view('index.listing', [
            'view' => \App\Helpers\Utils::main(Self::class, new \App\Product())
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * 
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
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('products.edit', [
            'view' => \App\Helpers\Utils::important(
                Self::class,
                \App\Helpers\Utils::EDIT,
                (object) \App\Product::find($id)->toArray()
            )
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules =  [
            "brand_id" => "required|integer",
            "name" => "required|max:32",
            "info" => "required",
            "detail" => "required"
        ];

        $messages = [
            "brand_id.integer" => "O código da marca deve ser inteiro",
            "name.max" => "O nome não pode ser maior que 32 caracteres"
        ];

        $request->validate($rules, $messages);

        \App\Product::find($id)->update($request->all());

        return view('index.listing', [
            'view' => \App\Helpers\Utils::main(Self::class, new \App\Product())
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
