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
            \App\Helpers\DOM::ALIAS => '#',
            \App\Helpers\DOM::BODY => ['id'],
            \App\Helpers\DOM::TYPE => \App\Helpers\DOM::__COLUMN,
        ],
        [
            \App\Helpers\DOM::ALIAS => 'Description',
            \App\Helpers\DOM::BODY => ['name'],
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
    ];

    /** @var array */
    public const REPORT = [
        \App\Report\Report::FIELDS => [
            'id' => [
                \App\Report\Report::WIDTH => 30,
                \App\Report\Report::ACTIVE => true
            ],
            'name' => [
                \App\Report\Report::WIDTH => 80,
                \App\Report\Report::ACTIVE => true
            ],
            'deleted_at' => [
                \App\Report\Report::WIDTH => 40,
                \App\Report\Report::ACTIVE => false
            ],
            'created_at' => [
                \App\Report\Report::WIDTH => 50,
                \App\Report\Report::ACTIVE => true
            ],
            'updated_at' => [
                \App\Report\Report::WIDTH => 40,
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
