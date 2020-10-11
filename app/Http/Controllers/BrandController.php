<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @param void
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index.listing', [
            'view' => \App\Helpers\Utils::main(Self::class, new \App\Models\Brand())
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('brands.create', [
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
            "name" => "required|max:64|unique:brands",
        ];

        $messages = [
            "name.min" => "A descrição é obrigatória",
        ];

        $request->validate($rules, $messages);

        if (empty($request->name)) {
            return view('brands.create', ['view' => $this->data]);
        }

        \App\Models\Brand::create([
            'name' => $request->name,
        ]);

        return view('index.listing', [
            'view' => \App\Helpers\Utils::main(Self::class, new \App\Models\Brand())
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
        return view('brands.edit', [
            'view' => \App\Helpers\Utils::important(
                Self::class,
                \App\Helpers\Utils::EDIT,
                (object) \App\Models\Brand::find($id)->toArray()
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
        $rules =  [
            "name" => "required|max:64"
        ];

        $messages = [
            "name.min" => "A descrição é obrigatória",
        ];

        $request->validate($rules, $messages);

        \App\Models\Brand::where('id', $id)->update(['name' => $request->name]);

        return view('index.listing', [
            'view' => \App\Helpers\Utils::main(Self::class, new \App\Models\Brand())
        ]);
    }

    /**
     * Remove the specified resource from storage.
     * 
     * We cannot destroy a brand that is linked to a product.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): array
    {
        if (($count = \App\Models\Product::where('brand_id', $id)->count()) > 0) {
            return [
                'status' => false,
                'timestamp' => date("Y/m/d H:i:s"),
                "message" => "This brand cannot be deleted from the system, as {$count} product(s) are related to it.",
                "id" => $id
            ];
        }

        \App\Models\Brand::where('id', $id)->delete();

        return \App\Helpers\Utils::JSONDestroyArray(true, $id, 'Brand');
    }
}
