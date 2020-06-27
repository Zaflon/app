<?php

namespace App\Helpers;

use stdClass;
use Illuminate\Support\Facades\Session;

final class Utils
{
    /** @var string */
    public const LISTING = 'Listing';

    /** @var string */
    public const EDIT = 'Edit';

    /** @var string */
    public const CREATE = 'Create';

    /** @var string */
    public const LOGIN = 'Login';

    /**
     * Set all parameters for main listing.
     * 
     * @param void
     */
    public static function main(
        string $str,
        \Illuminate\Database\Eloquent\Model $rules
    ): stdClass {
        $list = self::important($str, self::LISTING, (object) []);

        $list->header = $rules::data();

        $list->paginate = self::arr2obj($rules::paginate(10)->toArray());

        $list->list = $list->paginate->data;

        return $list;
    }

    /**
     * Informação que todo módulo possui (create | edit).
     * 
     * @param string $str
     * 
     * @return stdClass
     */
    public static function important(
        string $str,
        string $act,
        object $reg
    ): stdClass {
        $list = new stdClass();

        session_start();

        if ((bool) empty($reg) === false) {
            $list->register = $reg;
        }

        $list->controller = self::ctrlr2string($str);

        if (!((string) $act === self::LOGIN)) {
            $list->user = (object) Session::get(\App\Http\Controllers\UserController::USER_CREDENTIALS);
        }

        $list->action = $act;

        return $list;
    }

    /**
     * Converts an array in object.
     * 
     * @param array $arr
     * 
     * @return object
     */
    public static function arr2obj(array $arr): object
    {
        return json_decode(json_encode($arr, JSON_FORCE_OBJECT));
    }

    /**
     * Check if an $needle is subarray of $arr.
     * 
     * @param array $needle
     * @param array $arr
     * 
     * @return bool
     */
    public static function ArrayContains(array $needle, array $arr): bool
    {
        $c = 0;

        foreach ($needle as $array) {
            $c += (int) in_array($array, $arr) ? 1 : 0;
        }

        return (int) $c === (int) count($needle) ? true : false;
    }

    /**
     * Returns the input CamelCasedString as an underscored_string.
     * 
     * @param string $str
     * 
     * @return string
     */
    public static function underscore(string $str): string
    {
        return mb_strtolower(preg_replace('/(?<=\\w)([A-Z])/', "_" . '\\1', $str));
    }

    /**
     * Recebe uma string contendo um controller e o namespace do mesmo e retorna o nome característico do módulo em questão.
     * 
     * @example App\Http\Controllers\ColorController Color
     * @example App\Http\Controllers\PaymentMethodController PaymentMethod
     * 
     * @param string $str
     * 
     * @return string
     */
    public static function ctrlr2string(string $str): string
    {
        return (string) preg_replace('/(App\\\\Http\\\\Controllers\\\\)|(Controller)/', '', $str);
    }
}
