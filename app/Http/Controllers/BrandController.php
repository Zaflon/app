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
            'view' => \App\Helpers\Utils::main(Self::class, new \App\Brand())
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
            "name" => "required|max:64"
        ];

        $messages = [
            "name.min" => "A descrição é obrigatória",
        ];

        $request->validate($rules, $messages);

        if (empty($request->name)) {
            return view('brands.create', ['view' => $this->data]);
        }

        \App\Brand::create([
            'name' => $request->name,
        ]);

        return view('index.listing', [
            'view' => \App\Helpers\Utils::main(Self::class, new \App\Brand())
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
                (object) \App\Brand::find($id)->toArray()
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

        \App\Brand::where('id', $id)->update(['name' => $request->name]);

        return view('index.listing', [
            'view' => \App\Helpers\Utils::main(Self::class, new \App\Brand())
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): array
    {
        \App\Brand::where('id', $id)->delete();

        return \App\Helpers\Utils::JSONDestroyArray(true, $id, 'Brand');
    }
}
