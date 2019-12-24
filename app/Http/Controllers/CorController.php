<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CorController extends Controller
{
    /**
     * Cabeçalho da listagem.
     *
     * @var array
     */
    private $optionsIconsList = [
        "#" => [
            'alias' => "#",
            'body' => 'cd_cor'
        ],
        "Descrição" => [
            'alias' => "Descrição",
            'body' => 'ds_cor'
        ],
        "Hexadecimal" => [
            'alias' => "Hexadecimal",
            'body' => 'ds_hexadecimal'
        ],
        "Informação" => [
            'alias' => "Informação",
            "body" => "icon_url_info"
        ],
        "Edição" => [
            'alias' => "Edição",
            "body" => "icon_url_edit"
        ],
        "Exclusão" => [
            'alias' => "Exclusão",
            "body" => "icon_url_delete"
        ],
        "Imagem" => [
            'alias' => "Imagem",
            "body" => "icon_url_ds_color_hexadecimal"
        ]
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data->list = $this->find();
        $this->data->action = 'Listagem';

        $tmp = json_decode(json_encode($this->optionsIconsList), false);

        echo "<pre>";
        var_dump($tmp->{"#"}->{"alias"});
        echo "</pre>";

        $this->data->header = (object) $this->optionsIconsList;

        return view('cor.index', ['data' => $this->data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data->action = "Cadastro";

        return view('cor.create', ['data' => $this->data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->data->action = "Cadastro";

        if (empty($request->ds_cor && $request->ds_hexadecimal)) {
            return view('cor.create', ['data' => $this->data]);
        }

        $this->save([
            'cd_cor' => null,
            'ds_cor' => $request->ds_cor,
            'ds_hexadecimal' => $request->ds_hexadecimal
        ]);

        return view('cor.create', ['data' => $this->data]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->data->action = "Informação";

        $this->data->list = $this->find($id);

        return view('cor.show', ['data' => $this->data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id = 0)
    {
        $this->data->list = $this->find($id);
        $this->data->action = "Edição";

        return view('cor.edit', ['data' => $this->data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id = 0)
    {
        $this->save([
            'cd_cor' => $request->cd_cor,
            'ds_cor' => $request->ds_cor,
            'ds_hexadecimal' => $request->ds_hexadecimal
        ]);

        $this->data->list = $this->find();
        $this->data->action = "Listagem";
        $this->data->header = (object) $this->optionsIconsList;

        return view('cor.index', ['data' => $this->data]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id = 0)
    {
        $data = $this->find();

        foreach ($data as $key => $dado) {
            if ($dado->cd_cor == $id) {
                unset($data->{$key});
            }
        }

        $this->insert((object) $data);

        $this->data->list = $this->find();
        $this->data->action = "Listagem";
        $this->data->header = (object) $this->optionsIconsList;

        return view('cor.index', ['data' => $this->data]);
    }

    /**
     * Método responsável por simular uma consulta à base de dados do sistema.
     *
     * @param void
     */
    private function find(int $id = 0)
    {
        if ($id === 0) {
            return json_decode(file_get_contents("../database/tb_cor.JSON"));
        } else {
            $dadosRetorno = [];

            foreach ($this->find() as $key => $dado) {
                if ($id == $dado->cd_cor) {
                    $dadosRetorno = $dado;
                }
            }

            return $dadosRetorno;
        }
    }

    /**
     * Método responsável por simular uma consulta à base de dados do sistema.
     *
     * Se a chave primária não for informada, deve-se crir um novo registro
     *
     * @param void
     */
    private function save(array $data_save = []): int
    {
        if (empty($data_save['cd_cor'])) {
            $data = $this->find();

            $fl_can_save = true;
            $nr_registro = 0;

            foreach ($data as $key => $dado) {
                if (strtolower($dado->ds_cor) === strtolower($data_save['ds_cor']) || strtolower($dado->ds_hexadecimal) === strtolower($data_save['ds_hexadecimal'])) {
                    $fl_can_save = false;
                }

                if ($dado->cd_cor > $nr_registro) {
                    $nr_registro = $dado->cd_cor;
                }
            }

            $nr_registro = $nr_registro + 1;

            $data = (array) $data;

            $data[] = [
                "cd_cor" => $nr_registro,
                "ds_cor" => $data_save['ds_cor'],
                "ds_hexadecimal" => $data_save['ds_hexadecimal']
            ];

            if ($fl_can_save) {
                $this->insert((object) $data);
            } else {
                echo "Cadastro duplicado";
            }
        } else {
            $data = $this->find();

            $data = (array) $data;

            foreach ($data as $key => $dado) {
                if ($dado->cd_cor == $data_save['cd_cor']) {
                    $data[$key]->cd_cor = $data_save['cd_cor'];
                    $data[$key]->ds_cor = $data_save['ds_cor'];
                    $data[$key]->ds_hexadecimal = $data_save['ds_hexadecimal'];
                }
            }

            $nr_registro = $data_save['cd_cor'];

            $this->insert((object) $data);
        }

        return $nr_registro;
    }

    /**
     * Método responsável pela centralização da gerência de salvar os dados.
     */
    private function insert(\stdClass $data = null): bool
    {
        file_put_contents("../database/tb_cor.JSON", json_encode($data));

        return true;
    }
}
