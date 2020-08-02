<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /** @var string */
    private const INVALID_CREDENTIALS_MESSAGE = 'Sorry, the email or password you entered is incorrect. Please try again.';

    /** @var string */
    public const USER_CREDENTIALS = 'User';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('index.listing', [
            'view' => \App\Helpers\Utils::main(Self::class, new \App\User())
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create', [
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
        return view('index.listing', [
            'view' => \App\Helpers\Utils::main(Self::class, new \App\User())
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
        return view('components.box');
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
        return view('users.edit', [
            'view' => \App\Helpers\Utils::important(Self::class, \App\Helpers\Utils::EDIT, (object) \App\User::find($id)->toArray())
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
        \App\User::where('id', $id)->update([
            'email' => $request->email,
            'name' => $request->name
        ]);

        \App\Helpers\Utils::update($id);

        return view('index.listing', [
            'view' => \App\Helpers\Utils::main(Self::class, new \App\User())
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return \App\Helpers\Utils::JSONDestroyArray(true, $id, 'User');
    }

    /**
     * Validate an User.
     * 
     * @param Request $request
     */
    public function autenticate(Request $request)
    {
        $build = \App\User::select(['id', 'name', 'email', 'password'])->where('email', $request->email);

        if ($build->count() > 0) {
            if ((bool) (\Illuminate\Support\Facades\Hash::check($request->password, $build->first()->password)) === true) {
                \App\Helpers\Utils::update($build->first()->id);

                return redirect()->route('app');
            }
        }

        return $this->login($request)->withErrors([self::INVALID_CREDENTIALS_MESSAGE]);
    }

    /**
     * Render an empty login form (Log In).
     * 
     * @param void
     * 
     * @return \Illuminate\Http\Response
     */
    public function login(): \Illuminate\View\View
    {
        return view('login.login', [
            'view' => \App\Helpers\Utils::important(Self::class, \App\Helpers\Utils::LOGIN, (object) [])
        ]);
    }

    /**
     * Render an empty login form (Log Out).
     * 
     * @param void
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(): \Illuminate\Http\RedirectResponse
    {
        Session::flush();

        return redirect()->route('login');
    }
}
