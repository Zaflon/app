<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GenericPDFReportController extends Controller
{
    /** @var array */
    private const REPORT = [
        1 => \App\Http\Controllers\ColorController::class
    ];

    /**
     * Getter Method.
     * 
     * @param int $id
     * 
     * @return string
     */
    public function __get(int $id): string
    {
        return self::REPORT[$id];
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
     */
    public function show(int $id): void
    {
        call_user_func_array(["App" . "\\" . "Report" . "\\" . \App\Helpers\Utils::ctrlr2string($this->__get($id)) . 'Report', 'PDF'], []);
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
}
