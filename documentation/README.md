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

> Ao iniciar o projeto a partir do download de um repositório, rodar o comando `cp .env.example .env`

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

#### Passagem de um trecho de código html como parâmetro
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

## Models