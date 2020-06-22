<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;

final class Html
{
    /** @var string */
    public const TYPES = 'Types';

    /** @var string */
    public const HEXADECIMAL = 'hexadecimal';
    /** @var string */
    public const IMAGE = 'image';
    /** @var string */
    public const COLUMN = 'column';

    /** @var string */
    public const ALIAS = 'alias';
    /** @var string */
    public const TYPE = 'type';
    /** @var string */
    public const BODY = 'body';

    /** @var array */
    public const SPAN = [
        self::TYPES => [
            self::HEXADECIMAL => self::HEXADECIMAL,
            self::IMAGE => self::IMAGE
        ]
    ];

    /**
     * Return an span element.
     * 
     * @param object $dado
     * @param string $type
     * @param object $field
     * 
     * @return string
     */
    public static function span(object $dado, string $type, object $field): string
    {
        if ((string) $type === self::SPAN[self::TYPES][self::HEXADECIMAL]) {
            return "<span class = \"dot\" style = \"background-color: #{$dado->{$field->body}}\">&nbsp;</span>";
        } else {
            Log::alert("SPAN => ERROR!");

            return '<span style="color: #1860A7;">an error occurred</span>';
        }
    }

    /**
     *  Método responsável pela exibição de um select.
     *
     *  @param string $name
     *
     *  @param array $data
     *
     *  @param array $options
     */
    public static function select($name = "select_generico", $data = [], $options = [])
    {
        $select = "<select class=\"custom-select\" id= {$name} name = {$name}\">";

        if (!isset($options["selected"])) {
            $options["selected"] = md5(date("d-m-Y H:i:s"));
        }

        foreach ($data as $key => $dados) {
            if ($key == $options["selected"]) {
                $select .= "<option value = {$key} selected>{$dados}</option>";
            } else {
                $select .= "<option value = {$key}>{$dados}</option>";
            }
        }

        $select .= "</select>";

        return $select;
    }

    /**
     *
     */
    public static function input()
    {
    }

    /**
     *
     */
    public static function img()
    {
    }

    public static function a()
    {
    }
}