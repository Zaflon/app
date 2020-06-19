<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StockController extends Controller
{
    /** @var string */
    public const INCREMENT = 45;
    /** @var string */
    public const DECREMENT = 43;
    /** @var string */
    public const EVENT = 'StockCreation';
    /** @var string */
    public const INVALID_INTEGER_EXCEPTION_MESSAGE = "Item code value must to be greater than zero";

    /**
     * Constructor Method.
     * 
     * @param void
     */
    public function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Add Method.
     * 
     * @param int $id
     * @param StockLocation $stock
     * 
     * @return Self
     */
    public function add(
        int $id = 0,
        \App\StockLocation $stock
    ): Self {
        if ((bool) ($id > 0) === false || !filter_var($id, FILTER_VALIDATE_INT)) {
            throw new \InvalidArgumentException(self::INVALID_INTEGER_EXCEPTION_MESSAGE);
        }
        return $this;
    }

    /**
     * Change Method.
     * 
     * @param int $id
     * @param StockLocation $stock
     * @param int $quantity
     * @param int $type
     * 
     * @return Self
     */
    public function change(
        int $id = 0,
        \App\StockLocation $stock,
        int $quantity = 0,
        int $type = self::INCREMENT
    ): Self {
        return $this;
    }

    /**
     * Remove Method.
     * 
     * @param int $id
     * @param StockLocation $stock
     * 
     * @return Self
     */
    public function remove(
        int $id = 0,
        \App\StockLocation $stock
    ): Self {
        return $this;
    }
}
