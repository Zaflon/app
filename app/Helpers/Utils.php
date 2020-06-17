<?php

namespace App\Helpers;

use stdClass;

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
     * Constructor Method.
     * 
     * @param void
     */
    private function __construct()
    {
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
        $list->list = $rules::all()->toArray();

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

        $list->chunk = self::Chunk();

        $list->controller = self::ctrlr2string($str);

        $list->user = (object) $_SESSION[\App\Http\Controllers\UserController::USER_CREDENTIALS];

        $list->action = $act;

        return $list;
    }

    /**
     * Set routes list into SimpleXMLElement.
     * 
     * @param void
     */
    public static function Chunk(): \SimpleXMLElement
    {
        $xmlChunk = self::ReadChunk();

        $dadosRetorno = array_filter(array_map(function (object $data) {
            return $data->getName();
        }, app()->routes->getRoutes()));

        foreach ($xmlChunk->Chunk->AttachedElement->Child->xBit as $x) {
            $x->CompletePath = in_array((string) $x->BasicPath, $dadosRetorno) ? route((string) $x->BasicPath) : route('app');
        }

        return $xmlChunk;
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
    private static function ctrlr2string(string $str): string
    {
        return (string) preg_replace('/(App\\\\Http\\\\Controllers\\\\)|(Controller)/', '', $str);
    }

    /**
     * Get an SimpleXMLElement of Chunk Elements.
     * 
     * @param void
     * 
     * @return \SimpleXMLElement
     */
    public static function ReadChunk(): \SimpleXMLElement
    {
        return simplexml_load_string(file_get_contents(dirname(dirname(__DIR__)) . '/resources/Chunk.XML'));
    }
}
