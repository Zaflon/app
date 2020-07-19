<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Color extends Model
{
    /** @var array */
    protected $fillable = ['color', 'hexadecimal'];

    use SoftDeletes;

    /** @var array */
    protected const DATA = [
        [
            \App\Helpers\Html::ALIAS => '#',
            \App\Helpers\Html::BODY => 'id',
            \App\Helpers\Html::TYPE => \App\Helpers\Html::COLUMN,
        ],
        [
            \App\Helpers\Html::ALIAS => 'Description',
            \App\Helpers\Html::BODY => 'color',
            \App\Helpers\Html::TYPE => \App\Helpers\Html::COLUMN,
        ],
        [
            \App\Helpers\Html::ALIAS => 'Descrição',
            \App\Helpers\Html::BODY => 'cor',
            \App\Helpers\Html::TYPE => \App\Helpers\Html::COLUMN
        ],
        [
            \App\Helpers\Html::ALIAS => 'Hexadecimal',
            \App\Helpers\Html::BODY => 'hexadecimal',
            \App\Helpers\Html::TYPE => \App\Helpers\Html::COLUMN,
        ],
        [
            \App\Helpers\Html::ALIAS => 'Information',
            \App\Helpers\Html::TYPE => 'info',
        ],
        [
            \App\Helpers\Html::ALIAS => 'Edition',
            \App\Helpers\Html::TYPE => 'edit',
        ],
        [
            \App\Helpers\Html::ALIAS => 'Delete',
            \App\Helpers\Html::TYPE => 'delete',
        ],
        [
            \App\Helpers\Html::ALIAS => 'Image',
            \App\Helpers\Html::BODY => 'hexadecimal',
            \App\Helpers\Html::TYPE => \App\Helpers\Html::HEXADECIMAL,
        ]
    ];

    /** @var array */
    public const REPORT = [
        \App\Report\Report::FIELDS => [
            'id' => [
                \App\Report\Report::WIDTH => 10,
                \App\Report\Report::ACTIVE => true
            ],
            'cor' => [
                \App\Report\Report::WIDTH => 20,
                \App\Report\Report::ACTIVE => true
            ],
            'color' => [
                \App\Report\Report::WIDTH => 20,
                \App\Report\Report::ACTIVE => true
            ],
            'couleur' => [
                \App\Report\Report::WIDTH => 15,
                \App\Report\Report::ACTIVE => true
            ],
            'farbe' => [
                \App\Report\Report::WIDTH => 15,
                \App\Report\Report::ACTIVE => true
            ],
            'colore' => [
                \App\Report\Report::WIDTH => 15,
                \App\Report\Report::ACTIVE => true
            ],
            'tonalidad' => [
                \App\Report\Report::WIDTH => 15,
                \App\Report\Report::ACTIVE => true
            ],
            'kleur' => [
                \App\Report\Report::WIDTH => 15,
                \App\Report\Report::ACTIVE => true
            ],
            'hexadecimal' => [
                \App\Report\Report::WIDTH => 15,
                \App\Report\Report::ACTIVE => true
            ],
            'deleted_at' => [
                \App\Report\Report::WIDTH => 15,
                \App\Report\Report::ACTIVE => false
            ],
            'created_at' => [
                \App\Report\Report::WIDTH => 30,
                \App\Report\Report::ACTIVE => true
            ],
            'updated_at' => [
                \App\Report\Report::WIDTH => 30,
                \App\Report\Report::ACTIVE => true
            ],
        ],
        \App\Report\Report::INFO => [
            \App\Report\Report::NAME => 'COLORS REPORT',
            \App\Report\Report::FILENAME => 'ColorsReport',
            \App\Report\Report::HEIGHT => 4
        ]
    ];

    /**
     * Retorna informações para a listagem.
     * 
     * @param void
     * 
     * @return object
     */
    public static function data(): object
    {
        return \App\Helpers\Utils::arr2obj(self::DATA);
    }

    /**
     * Get informations about listing.
     * 
     * @param int $id
     * 
     * @return array
     */
    public static function info(int $id = 0): array
    {
        $data = self::find($id);

        return [
            "title" => "Information about #{$data->id}",
            "id" => $data->id,
            "attributes" => [
                "width" => 400,
            ],
            "data" => [
                "#" => [
                    "self" => $data->id,
                    "title" => "Color's Primary Key",
                ],
                "Hexadecimal" => [
                    "self" => $data->hexadecimal,
                    "title" => "Hexadecimal Code",
                ],
                "Label" => [
                    "self" => $data->color,
                    "title" => "Color's Description",
                ],
                "Created" => [
                    "self" => $data->created_at,
                    "title" => "Created At"
                ]
            ],
        ];
    }
}
