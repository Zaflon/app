<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /** @var array */
    public const REPORT = [
        \App\Report\Report::FIELDS => [
            'id' => [
                \App\Report\Report::WIDTH => 20,
                \App\Report\Report::ACTIVE => true
            ],
            'name' => [
                \App\Report\Report::WIDTH => 50,
                \App\Report\Report::ACTIVE => true
            ],
            'email' => [
                \App\Report\Report::WIDTH => 70,
                \App\Report\Report::ACTIVE => true
            ],
            'deleted_at' => [
                \App\Report\Report::WIDTH => 30,
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
            \App\Report\Report::NAME => 'USERS REPORT',
            \App\Report\Report::FILENAME => 'UsersReport',
            \App\Report\Report::HEIGHT => 4
        ]
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
            \App\Helpers\DOM::ALIAS => 'Email',
            \App\Helpers\DOM::BODY => ['email'],
            \App\Helpers\DOM::TYPE => \App\Helpers\DOM::__COLUMN
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
