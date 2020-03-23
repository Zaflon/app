<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Colors;

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
        return $this->list();
    }

    /**
     * Lista os registros
     * 
     * @param void
     */
    private function list()
    {
        $this->data->action = 'Listing';
        $this->data->list = (object) Colors::all()->toArray();
        $this->data->header = Colors::data();

        return view('color.index', ['data' => $this->data]);
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
        $this->data->action = "Register";

        return view('color.create', ['data' => $this->data]);
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
            "hexadecimal" => "required|min:6|max:6|unique:colors"
        ];

        $messages = [
            "hexadecimal.min" => "O hexadecimal deve conter seis caracteres",
            "unique" => "O atributo :attribute deve ser único"
        ];

        $request->validate($rules, $messages);

        $this->data->action = "Register";

        if (empty($request->color) || empty($request->hexadecimal)) {
            return view('color.create', ['data' => $this->data]);
        }

        Colors::create(['color' => $request->color, 'hexadecimal' => $request->hexadecimal]);

        return view('color.create', ['data' => $this->data]);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(int $id = 0): string
    {
        return json_encode(Colors::info($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id = 0)
    {
        $this->data->list = (object) Colors::find($id)->toArray();

        $this->data->action = "Edition";

        return view('color.edit', ['data' => $this->data]);
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
            "color" => "required",
            "hexadecimal" => "required|min:6|max:6"
        ];

        $messages = [
            "hexadecimal.min" => "O hexadecimal deve conter seis caracteres",
        ];

        $request->validate($rules, $messages);

        Colors::where('id', $id)->update(['hexadecimal' => $request->hexadecimal, 'color' => $request->color]);

        return $this->list();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id = 0): array
    {
        Colors::where('id', $id)->delete();

        return [
            'timestamp' => date("Y/m/d H:i:s"),
            'id' => $id,
            'status' => true
        ];
    }
}
