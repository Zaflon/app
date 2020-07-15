<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    /** @var array */
    protected $fillable = ['name'];

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
            \App\Helpers\Html::BODY => 'name',
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
}
