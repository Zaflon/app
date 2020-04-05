<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Colors extends Model
{
    /** @var array */
    protected $fillable = ['color', 'hexadecimal'];

    use SoftDeletes;

    /**
     * Retorna informações para a listagem.
     * 
     * @param void
     */
    public static function data(): object
    {
        return (object) [
            '#' => [
                'alias' => '#',
                'body' => 'id',
                'type' => 'column',
            ],
            'Description' => [
                'alias' => 'Description',
                'body' => 'color',
                'type' => 'column',
            ],
            'Hexadecimal' => [
                'alias' => 'Hexadecimal',
                'body' => 'hexadecimal',
                'type' => 'column',
            ],
            'Information' => [
                'alias' => 'Information',
                'type' => 'info',
            ],
            'Edition' => [
                'alias' => 'Edition',
                'type' => 'edit',
            ],
            'Delete' => [
                'alias' => 'Delete',
                'type' => 'delete',
            ],
            'Image' => [
                'alias' => 'Image',
                'body' => 'hexadecimal',
                'type' => 'hexadecimal',
            ]
        ];
    }

    /**
     * Retorna informações para o popup presente na listagem.
     * 
     * @param void
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
