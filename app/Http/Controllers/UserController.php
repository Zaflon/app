<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /** @var string */
    private const INVALID_CREDENTIALS_MESSAGE = 'Sorry, the email or password you entered is incorrect. Please try again.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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
     * Validate an User.
     * 
     * @param Request $request
     */
    public function autenticate(Request $request)
    {
        $LoggerFacts = User::where([
            'password' => (string) $request->password,
            'email' => (string) $request->email
        ])->first();

        if (
            (bool) is_null($LoggerFacts) === false &&
            (bool) ((int) $LoggerFacts->count() === 1) === true
        ) {
            $request->session()->put('user', (object) $LoggerFacts->toArray());

            return redirect('/app');
        } else {
            return $this->login($request)->withErrors([self::INVALID_CREDENTIALS_MESSAGE]);;
        }
    }

    /**
     * Render an empty login form.
     * 
     * @param void
     * 
     * @return \Illuminate\Http\Response
     */
    public function login(): \Illuminate\View\View
    {
        return view('login.login', ['data' => $this->data]);
    }
}
