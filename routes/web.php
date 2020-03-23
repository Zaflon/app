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
});

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
     * Método responsável pela criação de rotas para todos os métodos padrões do framework presentes no controlador MarcaController
     */
    Route::resource('Color', 'ColorController');

    /**
     * Exemplo de redirecionamento de rotas, ao chamar a url /Marca, retornamos /config
     * 
     * @see 127.0.0.1:8000/app/cor
     */
    Route::get('/Marca', function () {
        return redirect()->route('app.config');
    });

    Route::get('Archive/{controller}/{format}', 'ArchiveController@download')->name('Archive');
});

/**
 * Método POST, análogo á lógica empregada para o método get, bastando alterar o tipo de requisição.
 */
Route::post('/exit', function (Request $request) {
    return json_encode(["status" => true, "mensagem" => "usuário deslogado do sistema"]);
});

/**
 * Método DELETE, análogo á lógica empregada para o método get, bastando alterar o tipo de requisição.
 */
Route::delete('/delete', function (Request $request) {
    return json_encode(["status" => true, "mensagem" => "usuário excluído do sistema"]);
});
