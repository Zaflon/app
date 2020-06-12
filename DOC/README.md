<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="800"></p>

Pequena documentação de estudo do framework

## Configuração Inicial

1. Instalação do Apache

   > sudo pacman -S apache

2. Instalação de ferramentas necessárias posteriormente
    
   > sudo pacman -S curl git unzip

3. Instalação do composer

    > sudo su

    > curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer

4. Instalação da extensão RESTClient

    - Para testar a utilização de API's e outras funcionalidades dentro de nossa aplicação, é recomendável a utilização de alguma ferramenta para simular a requisição.

    <https://addons.mozilla.org/pt-BR/firefox/addon/restclient/>

## Extensões do Visual Studio Code

- [DotEnv](https://marketplace.visualstudio.com/items?itemName=mikestead.dotenv)

- [Laravel 5 Snippets](https://marketplace.visualstudio.com/items?itemName=onecentlin.laravel5-snippets)

- [Laravel Blade Snippets](https://marketplace.visualstudio.com/items?itemName=onecentlin.laravel-blade)

- [PHP Intelephense](https://marketplace.visualstudio.com/items?itemName=bmewburn.vscode-intelephense-client)

## Criação de um novo Projeto

- Create a new project

> composer create-project --prefer-dist laravel/laravel meu-projeto

- Install dependencies

> composer install

## Executando pela primeira vez o nosso projeto

- Run `php artisan serve` inside meu-projeto's directory

> Open the link <http://127.0.0.1:8000>

## Executando o projeto a partir do repositório presente no github

> `git clone https://github.com/MagicalStrangeQuark/ecommerce-laravel.git`

> `cd ecommerce-laravel && cp .env.example .env && php artisan key:generate`

> `composer install && composer update`

> `npm install && npm audit fix && npm run watch`

> `sudo systemctl start mariadb`

#### $LOGAR$ $NO$ $MARIADB$

`CREATE DATABASE laravel`

`CREATE USER 'laravel'@'localhost' IDENTIFIED BY 'P@ssw0rd'`

`GRANT ALL PRIVILEGES ON * . * TO 'laravel'@'localhost'`

`FLUSH PRIVILEGES`

> `php artisan migrate`

> `php artisan serve`

## Route

- Listando todas as rotas do meu projeto
    
    > php artisan route:list

    - Criamos, nesse exemplo, uma rota para a marca em que é passada uma descrição e um valor e essa retorna a impressão desse descrição tantas vezes.
 
    - É realiza uma validação para o nome, sendo permitido apenas caracteres alfanuméricos; e para o número, sendo apenas naturais.

    - <http://127.0.0.1:8000/app/Marca/Lat1ex/5>

    ```
        Route::get('/Marca/{name?}/{n}', function (string $name = '', int $n = 0) {
            for ($i = 0; $i < $n; $i++) {
                echo "<p>Marca: {$name}</p>";
            }
        })->where('name', '[A-Za-z\d]+')->where('n', '[0-9]+')->name('app.marca');
    ```

- Documentação oficial

    > <https://laravel.com/docs/6.x/routing>

- Testando uma requisição POST:

    - Adicionar a rota POST à lista de exceções da classe VerifyCsrfToken.

    - Através do RestClient, solicitar a url desejada. Por exemplo, <http://127.0.0.1:8000/exit>.
  
  - [Unicode Special Character](http://niviotec.blogspot.com/2015/12/codigos-unicode-para-caracteres.html)

## Controllers

- Criar um controlador para o gerenciamento de marcas dentro do nosso sistema

    > php artisan make:controller MarcaController --resource

- O objeto $request possui um método para a exibição do conteúdo que recebemos do formulário

    > $request->all()

## Views

### Blade

#### Condicional
```
@if
    <code>
@else
    <code>
@endif
```

#### Foreach
```
@foreach
    <code>
@endforeach
```

> O framework disponibiliza um objeto chamado $loop, que possibilita obter o primeiro e último elemento do laço de repetição.
 
> Reference: <https://tutsforweb.com/loop-variable-foreach-blade-laravel/>

### For

```
@for
    <code>
@endfor
```

#### Vazio

```
@empty
    <code>
@endempty
```

### Section

#### Passagem de variáveis como parâmetro

```
@yield('variable')

@section('<variable>', '<string>')
```

#### Passagem de um trecho de código HTML como parâmetro

```
@yield('<string>')

@section('<string>')

    <html-code-here>

@endsection('<string>')
```

### CSS

> Criarmos um arquivo simple-sidebar.css.

> Adicionando CSS ao projeto: Inserir o arquivo .css na pasta public/css

> Referenciar o arquivo com o seguinte código:

```
    <link href="{{ asset('css/simple-sidebar.css') }}" rel="stylesheet">
```

### COMPONENTES

Dentro do diretório resources/views, criar uma pasta chamada component.

Criamos o arquivo `list.blade.php` e inserimos um pequeno código html.

```
    <div style="border: 1px solid red">
        <h1>Component</h1>
        <p align="center"> Lista Component</p>
    </div>
```

Assim, chamamos nosso componente da seguinte forma:

```
@component('components.list')

@endcomponent
```

É possível passar conteúdo html para o componente, que será armazenado numa variável chamada $slot, da seguinte forma

```
@component('components.list')
    <h1>Conteúdo html sendo inserido no componente</h1>
@endcomponent
```
O conteúdo é recuperado então da seguinte forma

```
    <div style="border: 1px solid red">
        <h1>Component</h1>
        <p align="center"> Lista Component</p>
        <p>{{ $slot }}</p>
    </div>
```

Uma segunda forma é passar os parâmetros através de um array associativo.

```
    @component('components.list', ['msg' => 'Conteúdo html sendo inserido no componente'])

    @endcomponent
```

E recuperar o conteúdo através da variável criada a partir do índice.

```
    <div style="border: 1px solid red">
        <h1>Component</h1>
        <p align="center"> Lista Component</p>
        <p align="center">{{ $msg }}</p>
    </div>
```

Uma terceira forma de usar componentes é através da declaração dos mesmos. Na classe AppServiceProvider, inserimos a declaração do componente, através da sintaxe `Blade::component("<directory>", "<component-name>")` dentro do método boot();

Após isso incluímos a classe, inserindo a declaração `use Illuminate\Support\Facades\Blade`

Na na view, chamamos esse componente usando a seguinte sintaxe

```
    @<component-name>(['<variable>' => '<string>'])

    @end<component-name>
```
### Adicionando Bootstrap 4

No terminal, no diretório do nosso projeto, rodar os seguintes comandos:

    1. composer require laravel/ui

    2. php artisan ui bootstrap

    3. npm install && npm run dev

## Models

### Configuração do Banco de Dados e das Migrações

    1. Instalar o mysql

    2. Habilitar o driver do mysql ` extension=pdo_mysql `

    2. Verificar se o driver está habilitado corretamente, rodando o seguinte comando:

        php -r "echo defined('PDO::ATTR_DRIVER_NAME');";

    3. Rodar as migrações ` php artisan migrate `

### Criação de uma migração

    1. Criação de uma tabela chamada tb_colors

       php artisan make:migration create_table_colors

    2. Adicionar um campo chamado color a uma tabela chamada chemical_elements

       php artisan make:migration add_color_to_chemical_elements

    3. Criação de um relacionamento muitos para muitos (CORRIGIR ISSO - AULA 51)

    ```
        public function up()
        {
            Schema::create('product_department', function (Blueprint $table) {
                $table->unsignedBigInteger('product_id');
                $table->unsignedBigInteger('department_id');
                $table->foreign('product_id')->references('id')
                    ->on('products')->onDelete('cascade');
                $table->foreign('department_id')->references('id')
                    ->on('departments')->onDelete('cascade');
                $table->primary(['product_id','department_id']);
            });
        }
    ```

    ```
        public function down()
        {
            Schema::dropIfExists('product_department');
        }
    ```

    4. Criação de um modelo para a cor

        php aritsan make:model Cor

    5. Criação de um registro para a cor ,através do tinker

        php artisan tinker;

        use App\Colors;

        $colors = Colors::create(['color' => 'Preto', 'hexadecimal' => '000000']);

    6. Listagem de todos os registros para a cor, através do tinker

        use \App\Colors;
        
        php Colors::all();

    7. Número de registros

        use App\Colors;

        Colors::count();

    8. Select usando where

        use App\Colors;

        Colors::where('id', '>=', 2)->first();

        Colors::where('id', 2)->get();

        Colors::whereBetween('id', [1,2])->get();

        Colors::whereNotBetween('id', [2, 3])->get();

        Colors::whereIn('id', [2, 3])->get();

        Colors::whereNotIn('id', [2, 3])->get();

        Colors::where('color', 'like', '%k')->get();

        > As duas consultas abaixo são equivalentes

        Colors::where('color', 'like', 'B%')->orWhere('id', '>=', 7)->get();

        Colors::where(function($query){$query->where('color', 'like', 'B%')->orWhere('id', '>=', 7);})->get();

        Colors::where(function($query){
                $query->where('color', 'like', 'B%')->orWhere('id', '>=', 7);
            })
                ->where(function($query) {
                    $query->where('color', 'like', '%e%')
                    ->where('id', '>=', 10 );
                })->get();

        Colors::where('id', '>', '1')->orderBy('color', 'ASC')->get();

        Colors::where('id', '>', '1')->get()->pluck('id')->sum();

    9. Set Custom Primary Key

        No model, incluir a linha ` protected $primaryKey = 'id' `

    10. Atualizar um campo

        ```
            use App\Colors;

            $colors = Colors::find(2);
            $colors->color = "White2";
            $colors->save();
        ```

        ```
            Colors::find(6)->update(['color' => 'Bordô']);
        ```

    11. Soft Delete

        No model, incluir a trait, usando ` use SoftDeletes ` e incluir o namespace da mesma, com ` use Illuminate\Database\Eloquent\SoftDeletes `

        Inclusão do campo, através da seguinte migração ` $table->softDeletes() `

    12. Listar incluive os registros deletados

        use App\Colors;

        Colors::withTrashed->get();

    12. Verificar se um registro em particular, no caso, o id de número 2, está deletado

        use App\Colors;

        Colors::withTrashed()->find(2)->trashed();

    13. Excluir um registro de id igual a 3 com SoftDelete

        use App\Colors;

        Colors::find(5)->forceDelete();

## Helpers

    Criação de um arquivo Html.php em app/Helpers

    No arquivo composer.json, inserir o código

    ```
        "files": [
            "app/Helpers/Html.php"
        ]
    ```
    dentro da chave autoload.

    Rodar composer dump-autoload

    Adicionar, no diretório config, no arquivo app.php, em aliases, a linha ` 'Helper' => App\Helpers\Helper::class `

## Validação Formulário

No objeto request é possível acessar o método validate, bastando inserir um array associativo com a chave contendo o name do campo e o valor required, sendo
validado se existe conteúdo. No exemplo abaixo, estamos verificando se o campo color foi informado:

    ```
        $request->validate([
            "color" => "required"
        ]);
    ```
Para inserir mais validações simultaneamente, basta concatenar usando o pipe. No exemplo abaixo, não queremos mais de 10 caracteres no campo color.

    ```
        $request->validate([
            "color" => "required|max:10"
        ]);
    ```

Para validação única, basta informar unique:<nome-da-tabela>, para o camṕ desejado, o seguinte exemplo pode ser útil:

```
        $request->validate([
            "color" => "required|unique:colors",
            "hexadecimal" => "required|min:6|max:6|unique:colors,hexadecimal"
        ]);
```

Validação email:

```
        $request->validate([
            "email" => "required|email",
        ]);
```

Para utilização de mensagens genéricas, pode-se usar uma chave com o nome da validação, com a mensagem, sendo passsado o place holder :attribute. Exemplo:

```
        $request->validate([
            "color" => "required|unique:colors",
            "hexadecimal" => "required|min:6|max:6|unique:colors"
        ,[
            "hexadecimal.min" => "O hexadecimal deve conter seis caracteres",
            "unique" => "O atributo :attribute deve ser único"
        ]);
```

Para criação de mensagens abaixo do campo com erro / sucesso, o Laravel possui, dentro do objeto $errors, um método chamado `has()`, em que é
passado o name, sendo retornado um booleano indicando se aquele campo contém erros.