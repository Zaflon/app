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
            \App\Helpers\DOM::ALIAS => '#',
            \App\Helpers\DOM::BODY => ['id'],
            \App\Helpers\DOM::TYPE => \App\Helpers\DOM::__COLUMN,
        ],
        [
            \App\Helpers\DOM::ALIAS => 'Description',
            \App\Helpers\DOM::BODY => ['color'],
            \App\Helpers\DOM::TYPE => \App\Helpers\DOM::__COLUMN,
        ],
        [
            \App\Helpers\DOM::ALIAS => 'Descrição',
            \App\Helpers\DOM::BODY => ['cor'],
            \App\Helpers\DOM::TYPE => \App\Helpers\DOM::__COLUMN
        ],
        [
            \App\Helpers\DOM::ALIAS => 'Hexadecimal',
            \App\Helpers\DOM::BODY => ['hexadecimal'],
            \App\Helpers\DOM::TYPE => \App\Helpers\DOM::__COLUMN,
        ],
        [
            \App\Helpers\DOM::ALIAS => 'Information',
            \App\Helpers\DOM::TYPE => \App\Helpers\DOM::__INFORMATION,
        ],
        [
            \App\Helpers\DOM::ALIAS => 'Edition',
            \App\Helpers\DOM::TYPE => \App\Helpers\DOM::__EDITION,
        ],
        [
            \App\Helpers\DOM::ALIAS => 'Delete',
            \App\Helpers\DOM::TYPE => \App\Helpers\DOM::__DELETE,
        ],
        [
            \App\Helpers\DOM::ALIAS => 'Image',
            \App\Helpers\DOM::BODY => ['hexadecimal'],
            \App\Helpers\DOM::TYPE => \App\Helpers\DOM::__HEXADECIMAL,
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
     * @return \stdClass
     */
    public static function data(): \stdClass
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

    /**
     * Get data to index listing.
     * 
     * @param void
     * 
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return $this->paginate(\App\Helpers\Utils::PAGINATION);
    }
}
