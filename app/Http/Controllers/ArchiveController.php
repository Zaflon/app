<?php

namespace App\Providers;

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArchiveController extends Controller
{
    /** @var string */
    private const NEGRITO = 'B';

    /** @var string */
    private const SEM_TRACADO = '';

    /** @var int */
    private const ALTURA_LINHA = 4;

    /** @var string */
    private const  ARIAL = 'Arial';

    /** @var int */
    private const REPORTWIDTH = 200;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd("aqui");
    }

    public function download(string $controller, string $format)
    {
        $model = '\\App\\' . "{$controller}s";

        switch ($format) {
            case 'pdf':
                $this->pdf($model::all()->toArray(), $controller);
                break;
            case 'xml':
                dd("GERAR XML");
                break;
            case 'csv':
                dd("GERAR CSV");
                break;
        }
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

    public function pdf(array $data = [], string $controller): void
    {
        $pdf = new \FPDF('P');

        $pdf->SetFont(self::ARIAL, self::NEGRITO, 8);
        $pdf->SetMargins(5, 5, 5);

        $pdf->AddPage();

        $dadosRetorno = $this->correction($data);

        // HEADER
        foreach ($data[array_key_first($data)] as $key => $dado) {
            $pdf->Cell($dadosRetorno[$key], self::ALTURA_LINHA, $key, 1, 'L', false);
        }

        $pdf->Ln();
        $pdf->Ln();

        $pdf->SetFont(self::ARIAL, self::SEM_TRACADO, 8);

        // BODY
        foreach ($data as $key => $dado) {
            foreach ($dado as $kkey => $data) {
                $pdf->Cell($dadosRetorno[$kkey], self::ALTURA_LINHA, $data, 1, 'L', false);
            }
            $pdf->Ln();
        }

        $pdf->Output("{$controller}Report.pdf", 'D');
    }

    /**
     * Calcula o tamanho das colunas de forma dinâmica.
     */
    private function correction(array $data = []): array
    {
        $dadosRetorno = array_fill_keys(array_keys($data[array_key_first($data)]), 0);

        $nrCharacter = 0;

        foreach ($dadosRetorno as $key => $dado) {
            $dadosRetorno[$key] = strlen($key);
        }

        foreach ($data as $key => $dado) {
            foreach ($dado as $kkey => $dado) {
                if ((int) $dadosRetorno[$kkey] <= strlen($dado)) {
                    $dadosRetorno[$kkey] = strlen($dado);
                }
            }
        }

        foreach ($dadosRetorno as $key => $dado) {
            $nrCharacter += $dadosRetorno[$key];
        }

        foreach ($dadosRetorno as $key => $dado) {
            $dadosRetorno[$key] = (self::REPORTWIDTH / $nrCharacter) * $dadosRetorno[$key];
        }

        return $dadosRetorno;
    }
}
