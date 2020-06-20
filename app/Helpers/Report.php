<?php

namespace App\Helpers;

use Fpdf;

/**
 * Classe responsável pela obtenção e geração do PDF.
 */
class Report
{
    /** @var string */
    private const RETURN_DIRECTORY = "../";

    /** @var string */
    private const DIRECTORY_CONFIGURATION_DEFAULT = 'ReportConfig';

    /** @var array */
    public $content = [];

    /** @var string */
    private $children_method = '';




    // RENDER

    /**@var string */
    private const GRAPH = 1;
    /**@var string */
    private const QR_CODE = 2;
    /**@var string */
    private const BAR_CODE = 3;


    // FONTES

    /**@var string */
    private const ARIAL = '';


    // OPERAÇÃO
    /**@var string */
    private const ITERATION = '';
    /**@var string */
    private const TOTALIZE = '';

    // GERAL
    /** @var bool */
    const BORDER = true;
    /** @var int */
    const LINE_HEIGHT = 4;


    /**
     * Construtor da classe.
     *
     * @param void
     */
    public function __construct()
    {
        $this->get_contents();

        $this->get_pdf();
    }

    /**
     * Seta as configurações necessárias.
     *
     * @param void
     */
    public function get_contents()
    {
        $this->content['child_class'] = get_class($this);

        $this->content['path_contents'] = self::RETURN_DIRECTORY . self::DIRECTORY_CONFIGURATION_DEFAULT . '/' . str_replace(['Report\\'], '', get_class($this)) . 'Config.JSON';
    }

    /**
     * Realiza a a geração do PDF.
     *
     * @param void
     */
    public function get_pdf(): void
    {
        require_once "vendor/fpdf/fpdf/src/Fpdf/Fpdf.php";

        $dsPathConfig =  $this->getClassPath() . self::DIRECTORY_CONFIGURATION_DEFAULT . DIRECTORY_SEPARATOR . "ReportColorsConfig.JSON";

        /** Retorna as configurações do arquivo */
        $config = file_get_contents($dsPathConfig);

        /** Transforma os dados em Objeto */
        $config = json_decode($config);

        $pdf = new Fpdf\FPDF();

        $pdf->SetMargins($config->size_layout->margin_left, $config->size_layout->margin_top, $config->size_layout->margin_right);
        $pdf->AddPage();

        $pdf->SetFont($config->font_layout->general_data_font, 'B', 6);

        // General data
        $pdf->Cell(50, self::ALTURA, 'Hello World!', self::BORDER, 0, false);
        $pdf->Cell(50, self::ALTURA, 'Hello World!', self::BORDER, 0, false);
        $pdf->Cell(50, self::ALTURA, 'Report', self::BORDER, 0, false);
        $pdf->Cell(50, self::ALTURA, Date("d/m/Y H:i:s"), self::BORDER, 0, false);

        $pdf->Ln();

        $pdf->SetFont($config->font_layout->header_font, 'B', 6);

        // Header

        $pdf->Ln();

        $pdf->SetFont($config->font_layout->body_font, '', 6);

        foreach ($config->body_layout as $key => $column) {
            $pdf->Cell($column->width, self::ALTURA, $column->column_title, self::BORDER, 0, false);
        }

        $pdf->Ln();

        foreach ($this->data() as $key => $line) {
            foreach (array_keys(get_object_vars($line)) as $key => $column) {
                $pdf->Cell($config->body_layout->$column->width, self::ALTURA, $line->$column, self::BORDER, 0, false);
            }

            $pdf->Ln();
        }

        // Footer
        $pdf->Cell(25, self::ALTURA, 'Hello World!', self::BORDER, 0, false);
        $pdf->Cell(25, self::ALTURA, 'Hello World!', self::BORDER, 0, false);
        $pdf->Cell(25, self::ALTURA, rand(20, 30), self::BORDER, 0, false);

        // Body
        $pdf->Output();

        /** Caminho em que o arquivo será salvo */
        $this->content['file_path'] = base64_encode('path');
    }

    /**
     * Método responsável pela simulação de um select.
     * 
     * Busca os dados através no arquivo /home/wesleyflores/Dropbox/PHP/LAYOUT_RELATORIO/Report/ReportColorsData.JSON, que contém um
     * array de retorno semelhante ao que teríamos se fizessemos através de um banco de dados.
     *
     * @param void
     */
    public function data()
    {
        dd(__DIR__);

        exit;

        $data = file_get_contents('/home/wesleyflores/Dr1box/PHP/LAYOUT_RELATORIO/Report/ReportColorsData.JSON');

        return json_decode($data);
    }

    /**
     * Retorna um diretório antes da pasta atual.
     * 
     * @param void
     */
    private function getClassPath()
    {

        return dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR;
    }

    /**
     * Getter Method
     */
    public function __get(string $value)
    {
        return $this->$value;
    }

    /**
     * Retorna o caminho do arquivo PDF.
     *
     * @param void
     */
    public function path(): string
    {
        return $this->content['file_path'];
    }

    /**
     * Setter Method
     */
    public function __set(string $name, $value = 0): void
    {
        $this->$name = $value;
    }
}

// <?php

// namespace App\Providers;

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;

// class ArchiveController extends Controller
// {
//     /** @var string */
//     private const NEGRITO = 'B';

//     /** @var string */
//     private const SEM_TRACADO = '';

//     /** @var int */
//     private const ALTURA_LINHA = 4;

//     /** @var string */
//     private const  ARIAL = 'Arial';

//     /** @var int */
//     private const REPORTWIDTH = 200;

//     /**
//      * Display a listing of the resource.
//      *
//      * @return \Illuminate\Http\Response
//      */
//     public function index()
//     {
//     }

//     /**
//      * Show the form for creating a new resource.
//      *
//      * @return \Illuminate\Http\Response
//      */
//     public function create()
//     {
//         //
//     }

//     /**
//      * Store a newly created resource in storage.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @return \Illuminate\Http\Response
//      */
//     public function store(Request $request)
//     {
//     }

//     /**
//      * Display the specified resource.
//      *
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function show($id)
//     {
//         dd("aqui");
//     }

//     public function download(string $controller, string $format)
//     {
//         $model = '\\App\\' . "{$controller}s";

//         switch ($format) {
//             case 'pdf':
//                 $this->pdf($model::all()->toArray(), $controller);
//                 break;
//             case 'xml':
//                 dd("GERAR XML");
//                 break;
//             case 'csv':
//                 dd("GERAR CSV");
//                 break;
//         }
//     }

//     /**
//      * Show the form for editing the specified resource.
//      *
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function edit($id)
//     {
//         //
//     }

//     /**
//      * Update the specified resource in storage.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function update(Request $request, $id)
//     {
//         //
//     }

//     /**
//      * Remove the specified resource from storage.
//      *
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function destroy($id)
//     {
//         //
//     }

//     public function pdf(array $data = [], string $controller): void
//     {
//         $pdf = new \FPDF('P');

//         $pdf->SetFont(self::ARIAL, self::NEGRITO, 8);
//         $pdf->SetMargins(5, 5, 5);

//         $pdf->AddPage();

//         $dadosRetorno = $this->correction($data);

//         // HEADER
//         foreach ($data[array_key_first($data)] as $key => $dado) {
//             $pdf->Cell($dadosRetorno[$key], self::ALTURA_LINHA, $key, 1, 'L', false);
//         }

//         $pdf->Ln();
//         $pdf->Ln();

//         $pdf->SetFont(self::ARIAL, self::SEM_TRACADO, 8);

//         // BODY
//         foreach ($data as $key => $dado) {
//             foreach ($dado as $kkey => $data) {
//                 $pdf->Cell($dadosRetorno[$kkey], self::ALTURA_LINHA, $data, 1, 'L', false);
//             }
//             $pdf->Ln();
//         }

//         $pdf->Output("{$controller}Report.pdf", 'D');
//     }

//     /**
//      * Calcula o tamanho das colunas de forma dinâmica.
//      */
//     private function correction(array $data = []): array
//     {
//         $dadosRetorno = array_fill_keys(array_keys($data[array_key_first($data)]), 0);

//         $nrCharacter = 0;

//         foreach ($dadosRetorno as $key => $dado) {
//             $dadosRetorno[$key] = strlen($key);
//         }

//         foreach ($data as $key => $dado) {
//             foreach ($dado as $kkey => $dado) {
//                 if ((int) $dadosRetorno[$kkey] <= strlen($dado)) {
//                     $dadosRetorno[$kkey] = strlen($dado);
//                 }
//             }
//         }

//         foreach ($dadosRetorno as $key => $dado) {
//             $nrCharacter += $dadosRetorno[$key];
//         }

//         foreach ($dadosRetorno as $key => $dado) {
//             $dadosRetorno[$key] = (self::REPORTWIDTH / $nrCharacter) * $dadosRetorno[$key];
//         }

//         return $dadosRetorno;
//     }
// }



// <?php
//     namespace Report;

//     /** show errors */
//     ini_set('display_errors', 1);
//     ini_set('display_startup_errors', 1);
//     error_reporting(E_ALL);

//     /** debug function */
//     function dd($data = [], bool $exit = false)
//     {
//         echo "<pre>";
//         print_r($data);
//         echo "</pre>";
//         if ($exit) {
//             die();
//         }
//     }
    
//     require_once "Report/ReportColors.php";

//     if (file_exists("Report/ReportColors.php")) {
//         $report = new ReportColors();
//         $report->path();
//     }


//     report colors config

//     {
//         "size_layout": {
//           "margin_top": 5,
//           "margin_left": 5,
//           "margin_right": 5
//         },
//         "font_layout": {
//           "general_data_font": "Arial",
//           "header_font": "Arial",
//           "body_font": "Arial",
//           "footer_font": "Arial"
//         },
//         "header_layout": {
//           "company_name": {
//             "title": "Test Company Name",
//             "content": "tb_empresa&ds_empresa"
//           }
//         },
//         "body_layout": {
//           "tb_cor&cd_cor": {
//             "size": 10,
//             "width": 30,
//             "type": "integer",
//             "column_title": "Código"
//           },
//           "tb_cor&ds_cor": {
//             "size": 10,
//             "width": 90,
//             "type": "string",
//             "column_title": "Descrição"
//           },
//           "tb_cor&ds_hexadecimal": {
//             "size": 10,
//             "width": 40,
//             "type": "string",
//             "column_title": "Cor Hexadecimal"
//           }
//         },
//         "footer_layout": {},
//         "rules": {},
//         "fields": {}
//       }
      

//       report colors data

//       {
//         "0": {
//           "tb_cor&cd_cor": 1,
//           "tb_cor&ds_cor": "aliceblue",
//           "tb_cor&ds_hexadecimal": "#f0f8ff"
//         },
//         "1": {
//           "tb_cor&cd_cor": 2,
//           "tb_cor&ds_cor": "antiquewhite",
//           "tb_cor&ds_hexadecimal": "#faebd7"
//         },
//         "2": {
//           "tb_cor&cd_cor": 3,
//           "tb_cor&ds_cor": "aqua",
//           "tb_cor&ds_hexadecimal": "#00ffff"
//         },
//         "3": {
//           "tb_cor&cd_cor": 4,
//           "tb_cor&ds_cor": "aquamarine",
//           "tb_cor&ds_hexadecimal": "#7fffd4"
//         },
//         "4": {
//           "tb_cor&cd_cor": 5,
//           "tb_cor&ds_cor": "azure",
//           "tb_cor&ds_hexadecimal": "#f0ffff"
//         },
//         "5": {
//           "tb_cor&cd_cor": 6,
//           "tb_cor&ds_cor": "beige",
//           "tb_cor&ds_hexadecimal": "#f5f5dc"
//         },
//         "6": {
//           "tb_cor&cd_cor": 7,
//           "tb_cor&ds_cor": "bisque",
//           "tb_cor&ds_hexadecimal": "#ffe4c4"
//         },
//         "7": {
//           "tb_cor&cd_cor": 8,
//           "tb_cor&ds_cor": "black",
//           "tb_cor&ds_hexadecimal": "#000000"
//         },
//         "8": {
//           "tb_cor&cd_cor": 6,
//           "tb_cor&ds_cor": "blanchedalmond",
//           "tb_cor&ds_hexadecimal": "#ffebcd"
//         },
//         "9": {
//           "tb_cor&cd_cor": 6,
//           "tb_cor&ds_cor": "blue",
//           "tb_cor&ds_hexadecimal": "#0000ff"
//         },
//         "10": {
//           "tb_cor&cd_cor": 6,
//           "tb_cor&ds_cor": "blueviolet",
//           "tb_cor&ds_hexadecimal": "#8a2be2"
//         },
//         "11": {
//           "tb_cor&cd_cor": 6,
//           "tb_cor&ds_cor": "brown",
//           "tb_cor&ds_hexadecimal": "#a52a2a"
//         }
//       }
      