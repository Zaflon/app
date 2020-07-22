<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;
use InvalidArgumentException;

final class DOM
{
    /** @var string */
    public const __SELECT = '@SELECT@';
    /** @var string */
    public const __IMG = '@IMG@';
    /** @var string */
    public const __INPUT = '@INPUT@';
    /** @var string */
    public const __SPAN = '@SPAN@';
    /** @var string */
    public const __HEXADECIMAL = '@HEXADECIMAL@';
    /** @var string */
    public const __COLUMN = '@COLUMN@';
    /** @var string */
    public const __DELETE = '@DELETE@';
    /** @var string */
    public const __EDITION = '@EDIT@';
    /** @var string */
    public const __INFORMATION = '@INFORMATION@';

    /** @var string */
    public const TYPE = '@TYPE@';
    /** @var string */
    public const ALIAS = '@ALIAS@';
    /** @var string */
    public const BODY = '@BODY@';

    /** @var array */
    public const COMPONENT = '@COMPONENT@';

    /** @var string */
    public const __ID = 'id';
    /** @var string */
    public const __CLASS = 'class';
    /** @var string */
    public const __TITLE = 'title';
    /** @var string */
    public const __BACKGROUND_COLOR = 'background-color';

    /** @var array */
    protected array $DOM = [
        self::COMPONENT => NULL,
        self::__ID => NULL,
        self::__CLASS => NULL,
        self::__TITLE => NULL,
        self::__BACKGROUND_COLOR => NULL
    ];

    /**
     * Get an instance of this class.
     *
     * @param void
     *
     * @return Self
     */
    public static function DOM(): Self
    {
        return new Self();
    }

    /**
     * Setter Method.
     * 
     * @param void
     * 
     * @return Self|InvalidArgumentException
     */
    public function __set(
        string $arg,
        string $carry
    ): Self {
        if (in_array($arg, array_keys($this->DOM))) {
            $this->DOM[$arg] = $carry;

            return $this;
        }

        $this->ExceptionLogger(
            "This property :{$arg} does not belong to this class.",
            InvalidArgumentException::class
        );
    }

    /**
     * Getter Method.
     * 
     * @param string
     * 
     * @return string|InvalidArgumentException
     */
    public function __get(
        string $arg
    ): string {
        if (isset($this->DOM[$arg])) {
            return $this->DOM[$arg];
        }

        $this->ExceptionLogger(
            "This property :{$arg} does not belong to this class.",
            InvalidArgumentException::class
        );
    }

    /**
     * Logger Exception.
     * 
     * @param string $msg
     * 
     * @return \Exception
     */
    protected function ExceptionLogger(
        string $msg,
        string $e
    ): \Exception {
        Log::alert($msg);

        throw new $e($msg);
    }

    /**
     * Render Component,
     *
     * @param string $type
     *
     * @return string|InvalidArgumentException
     */
    public function Render(): string
    {
        switch ($this->DOM[self::COMPONENT]) {
            case self::__SELECT:
                break;

            case self::__IMG:
                break;

            case self::__INPUT:
                break;

            case self::__SPAN:
                $this->DOM[self::__ID] = $this->DOM[self::__ID] ?? 'sample-id';

                $s = sprintf(
                    '<span id = %s class = dot style = "background-color: #%s;">&nbsp;</span>',
                    $this->DOM[self::__ID],
                    $this->DOM[self::__BACKGROUND_COLOR]
                );

                return html_entity_decode($s);
        }

        $this->ExceptionLogger(
            "Render Method called on non existing component.",
            \InvalidArgumentException::class
        );
    }
}
