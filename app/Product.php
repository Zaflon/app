<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

final class Product extends Model
{
    /** @var array */
    protected $fillable = [
        'name',
        'weight',
        'info',
        'detail',
        'brand_id'
    ];

    /** @var array */
    protected const DATA = [
        [
            \App\Helpers\Html::ALIAS => '#',
            \App\Helpers\Html::BODY => 'id',
            \App\Helpers\Html::TYPE => \App\Helpers\Html::COLUMN,
        ],
        [
            \App\Helpers\Html::ALIAS => 'Name',
            \App\Helpers\Html::BODY => 'name',
            \App\Helpers\Html::TYPE => \App\Helpers\Html::COLUMN,
        ],
        [
            \App\Helpers\Html::ALIAS => 'Weight (Grams)',
            \App\Helpers\Html::BODY => 'weight',
            \App\Helpers\Html::TYPE => \App\Helpers\Html::COLUMN,
        ],
        [
            \App\Helpers\Html::ALIAS => 'Info',
            \App\Helpers\Html::BODY => 'info',
            \App\Helpers\Html::TYPE => \App\Helpers\Html::COLUMN,
        ],
        [
            \App\Helpers\Html::ALIAS => 'Detail',
            \App\Helpers\Html::BODY => 'detail',
            \App\Helpers\Html::TYPE => \App\Helpers\Html::COLUMN,
        ],
        [
            \App\Helpers\Html::ALIAS => 'Brand Code',
            \App\Helpers\Html::BODY => 'brand_id',
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
        ]
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
            'weight' => [
                \App\Report\Report::WIDTH => 20,
                \App\Report\Report::ACTIVE => true
            ],
            'detail' => [
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
            \App\Report\Report::NAME => 'PRODUCTS REPORT',
            \App\Report\Report::FILENAME => 'ProductsReport',
            \App\Report\Report::HEIGHT => 4
        ]
    ];

    /**
     * Brand.
     * 
     * @param void.
     */
    public function brand(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Brand::class);
    }


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
