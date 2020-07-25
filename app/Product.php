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
            \App\Helpers\DOM::ALIAS => '#',
            \App\Helpers\DOM::BODY => ['id'],
            \App\Helpers\DOM::TYPE => \App\Helpers\DOM::__COLUMN,
        ],
        [
            \App\Helpers\DOM::ALIAS => 'Name',
            \App\Helpers\DOM::BODY => ['name'],
            \App\Helpers\DOM::TYPE => \App\Helpers\DOM::__COLUMN,
        ],
        [
            \App\Helpers\DOM::ALIAS => 'Weight (Grams)',
            \App\Helpers\DOM::BODY => ['weight'],
            \App\Helpers\DOM::TYPE => \App\Helpers\DOM::__COLUMN,
        ],
        [
            \App\Helpers\DOM::ALIAS => 'Info',
            \App\Helpers\DOM::BODY => ['info'],
            \App\Helpers\DOM::TYPE => \App\Helpers\DOM::__COLUMN,
        ],
        [
            \App\Helpers\DOM::ALIAS => 'Detail',
            \App\Helpers\DOM::BODY => ['detail'],
            \App\Helpers\DOM::TYPE => \App\Helpers\DOM::__COLUMN,
        ],
        [
            \App\Helpers\DOM::ALIAS => 'Brand Code',
            \App\Helpers\DOM::BODY => ['brand_id'],
            \App\Helpers\DOM::TYPE => \App\Helpers\DOM::__COLUMN,
        ],
        [
            \App\Helpers\DOM::ALIAS => 'Brand Name',
            \App\Helpers\DOM::BODY => ['brand', 'name'],
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
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
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
     * @return \stdClass
     */
    public static function data(): \stdClass
    {
        return \App\Helpers\Utils::arr2obj(self::DATA);
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
        return $this::with('brand')->paginate(\App\Helpers\Utils::PAGINATION);
    }
}
