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

    /** @var array */
    public const REPORT = [
        \App\Report\Report::FIELDS => [
            'id' => [
                \App\Report\Report::WIDTH => 10,
                \App\Report\Report::ACTIVE => true
            ],
            'name' => [
                \App\Report\Report::WIDTH => 20,
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
            \App\Report\Report::NAME => 'BRANDS REPORT',
            \App\Report\Report::FILENAME => 'BrandsReport',
            \App\Report\Report::HEIGHT => 4
        ]
    ];

    /**
     * Get informations about listing.
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
