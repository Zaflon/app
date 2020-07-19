<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

final class GenericPDFReportController extends Controller
{
    /** @var array */
    private const REPORT = [
        1 => \App\Http\Controllers\ColorController::class,
        2 => \App\Http\Controllers\ProductController::class,
        3 => \App\Http\Controllers\BrandController::class
    ];

    /**
     * Get Listing.
     * 
     * @param void
     * 
     * @return array
     */
    public static function all(): array
    {
        return self::REPORT;
    }

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
        if (defined("{$this->pdf($id)}::REPORT")) {
            \App\Report\Report::create()->PDF(
                \App\Helpers\Utils::arr2obj($this->pdf($id)::REPORT),
                $this->pdf($id)::all()->take(42)
            );
        } else {
            dd("Report not found...");
        }
    }

    /**
     * Get Model.
     * 
     * @param int
     * 
     * @return string
     */
    public function pdf(int $id): string
    {
        return "\\App\\" . \App\Helpers\Utils::ctrlr2string($this->__get($id));
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
