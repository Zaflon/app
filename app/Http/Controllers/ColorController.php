<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ColorController extends Controller
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
            'view' => \App\Helpers\Utils::main(Self::class, new \App\Models\Color())
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @param void
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('colors.create', [
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
            "color" => "required|unique:colors",
            "hexadecimal" => "required|min:7|max:7|unique:colors"
        ];

        $messages = [
            "hexadecimal.min" => "O hexadecimal deve conter seis caracteres",
            "unique" => "O atributo :attribute deve ser único"
        ];

        $request->validate($rules, $messages);

        if (empty($request->color) || empty(str_replace('#', NULL, $request->hexadecimal))) {
            return view('color.create', ['view' => $this->data]);
        }

        \App\Models\Color::create([
            'color' => $request->color,
            'hexadecimal' => strtoupper(str_replace('#', NULL, $request->hexadecimal))
        ]);

        return view('index.listing', [
            'view' => \App\Helpers\Utils::main(Self::class, new \App\Models\Color())
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     * 
     * @return string
     */
    public function show(int $id = 0): string
    {
        return json_encode(\App\Models\Color::info($id));
    }

    /**
     * Show all colors via api.
     * 
     * @param void
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function listing(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'name' => 'Abigail',
            'state' => 'CA'
        ], 200, [
            'Content-Type' => 'application/json',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id = 0)
    {
        return view('colors.edit', [
            'view' => \App\Helpers\Utils::important(Self::class, \App\Helpers\Utils::EDIT, (object) \App\Models\Color::find($id)->toArray())
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
    public function update(Request $request, int $id = 0)
    {
        $rules =  [
            "color" => "required|unique:colors,color,{$request->id}",
            "hexadecimal" => "required|unique:colors,hexadecimal,{$request->hexadecimal}|min:7|max:7"
        ];

        $messages = [
            "hexadecimal.min" => "O hexadecimal deve conter seis caracteres",
        ];

        $request->validate($rules, $messages);

        \App\Models\Color::where('id', $id)->update(['hexadecimal' => strtoupper(str_replace('#', NULL, $request->hexadecimal)), 'color' => $request->color]);

        return view('index.listing', [
            'view' => \App\Helpers\Utils::main(Self::class, new \App\Models\Color())
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id = 0): array
    {
        \App\Models\Color::where('id', $id)->delete();

        return \App\Helpers\Utils::JSONDestroyArray(true, $id, 'Color');
    }
}
