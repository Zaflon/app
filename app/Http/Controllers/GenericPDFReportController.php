<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PharIo\Manifest\InvalidUrlException;

final class GenericPDFReportController extends Controller
{
    /** @var array */
    private const REPORT = [
        1 => \App\Http\Controllers\ColorController::class,
        2 => \App\Http\Controllers\ProductController::class,
        3 => \App\Http\Controllers\BrandController::class,
        4 => \App\Http\Controllers\CouponController::class,
        5 => \App\Http\Controllers\UserController::class
    ];

    /** @var array */
    private const __ERROR_PDF_NOT_CREATED = "Exporting the listing via PDF for this module has not yet been developed.";

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
        if (!defined("{$this->pdf($id)}::REPORT")) {
            throw new InvalidUrlException(self::__ERROR_PDF_NOT_CREATED);
        }

        \App\Report\Report::create()->PDF($this->config($id), $this->data($id));
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
     * Get Data.
     * 
     * @param int $id
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function data(int $id): \Illuminate\Database\Eloquent\Collection
    {
        return $this->pdf($id)::all()->take(42);
    }

    /**
     * Get Configuration for some PDF.
     * 
     * @param int $id
     * 
     * @return \stdClass
     */
    public function config(int $id): \stdClass
    {
        return \App\Helpers\Utils::arr2obj(\App\Helpers\Utils::ctrlr2model($this->__get($id))::REPORT);
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
