<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

/**
 * Todas as rotas estão inseridas no /app
 */
Route::prefix('/app')->group(function () {
    /**
     * Retorna a página inicial do nosso aplicativo.
     * 
     * @see http://127.0.0.1:8000/app
     */
    Route::get('/', function () {
        return view('app');
    })->name('app');

    /**
     * Rota responsável por receber um item e seu nome e imprimi-lo na tela
     * 
     * @see http://127.0.0.1:8000/app/Item/Mo!la 
     */
    Route::get('/Item/{name}', function (string $name = '') {
        return "<p>Item: {$name}</p>";
    })->where('name', '[A-Za-z\d\!]+');

    /**
     * Página responsável pela exibição das configurações do aplicativo
     * 
     * @see http://127.0.0.1:8000/app/config
     */
    Route::get('/config', function () {
        return view('config');
    })->name('app.config');


    /**
     * Color Route.
     */
    Route::resource('Color', 'ColorController');

    /**
     * Report Route for Color Controller.
     */
    Route::get('Color/pdf', 'ColorController@pdf')->name('color.pdf');
    Route::get('Color/csv', 'ColorController@csv')->name('color.csv');
    Route::get('Color/xml', 'ColorController@xml')->name('color.xml');


    /**
     * Exemplo de redirecionamento de rotas, ao chamar a url /Marca, retornamos /config
     * 
     * @see 127.0.0.1:8000/app/cor
     */
    Route::get('/Brand', function () {
        return redirect()->route('app.config');
    });

    Route::resource('User', 'UserController');
});

/**
 * Método POST, análogo á lógica empregada para o método get, bastando alterar o tipo de requisição.
 */
Route::post('/exit', function (Request $request) {
    return json_encode(["status" => true, "mensagem" => "usuário deslogado do sistema"]);
});

/** Rota responsável pelo retorno da página de login */
Route::get('/login', 'UserController@login')->name('login');

/** Rota de autenticação do usuário, no momento de login junto à página inicial do sistema */
Route::post('/autenticate', 'UserController@autenticate')->name('autenticate');

/**
 * Método DELETE, análogo á lógica empregada para o método get, bastando alterar o tipo de requisição.
 */
Route::delete('/delete', function (Request $request) {
    return json_encode(["status" => true, "mensagem" => "usuário excluído do sistema"]);
});
