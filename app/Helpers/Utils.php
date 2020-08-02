<?php

namespace App\Helpers;

use stdClass;
use Illuminate\Support\Facades\Session;
use InvalidArgumentException;
use Symfony\Component\Routing\Exception\InvalidParameterException;

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

    /** @var string */
    public const HOMEPAGE = 'Color.index';

    /** @var int */
    public const PAGINATION = 10;

    /**
     * Set all parameters for main listing.
     * 
     * @param void
     * 
     * @return \stdClass
     */
    public static function main(
        string $str,
        \Illuminate\Database\Eloquent\Model $rules
    ): stdClass {
        $list = self::important($str, self::LISTING, (object) []);

        $list->header = $rules::data();

        $list->paginate = self::arr2obj($rules->index()->toArray());

        $list->list = $rules->index()->items();

        return $list;
    }

    /**
     * User
     * 
     * @param void
     * 
     * @return stdClass
     */
    public static function user(): \stdClass
    {
        return self::arr2obj(Session::get(\App\Http\Controllers\UserController::class) ?? []);
    }

    /**
     * Update User Session.
     * 
     * @param void
     */
    public static function update(int $id)
    {
        Session::put(\App\Http\Controllers\UserController::class, \App\User::find($id)->toArray());
    }

    /**
     * Get an JSON from URL.
     * 
     * We can receive a JSON as an array or as an object, so we validate the return.
     * 
     * @param string $FILE
     * @param string $URL
     * 
     * @return \stdClass
     */
    public static function getSeederJSON(
        string $FILE,
        string $URL = "https://raw.githubusercontent.com/MagicalStrangeQuark/JSON/master/"
    ): \stdClass {
        $data = json_decode(file_get_contents($URL . rawurlencode($FILE)));

        return ($data instanceof \stdClass) ? $data : self::arr2obj($data);
    }

    /**
     * Extract the column of the table.
     * 
     * @param \stdclass $fields
     * @param \stdClass $obj
     * 
     * @return string
     */
    public static function extract(
        \stdClass $fields,
        object $obj
    ): string {
        $data = $obj;

        foreach ($fields as $field) {
            if (!isset($data->{$field})) {
                throw new InvalidArgumentException("This field :{$field} was not found.");
            }

            $data = $data->{$field};
        }

        return $data;
    }

    /**
     * Get an model instance from controller name.
     * 
     * @param string $str
     * 
     * @return string
     */
    public static function ctrlr2model(
        string $str
    ): string {
        return "\\App\\" . \App\Helpers\Utils::ctrlr2string($str);
    }

    /**
     * Information that every module has (create | edit).
     * 
     * @param string $str
     * @param string $act
     * @param object $reg
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

        if (
            (bool) empty($reg) === false
        ) {
            $list->register = $reg;
        }

        $list->controller = self::ctrlr2string($str);

        if (
            !((string) $act === self::LOGIN)
        ) {
            $list->user = (object) Session::get(\App\Http\Controllers\UserController::class);
        }

        $list->action = $act;

        $list->report = self::report($str);

        return $list;
    }

    /**
     * Report.
     * 
     * @param void
     * 
     * @return \stdClass
     */
    private static function report(string $str): \stdClass
    {
        $stub = new \stdClass();

        $key = array_search($str, \App\Http\Controllers\GenericPDFReportController::all());

        if ((bool)((int) $key) === true) {
            $stub->key = $key;

            return $stub;
        }

        throw new \Exception("Report for this module :{$str} not yet registered in the system.");
    }

    /**
     * Converts an array in \stdClass.
     * 
     * @param array $arr
     * 
     * @return \stdClass
     */
    public static function arr2obj(
        array $arr
    ): \stdClass {
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
    public static function ArrayContains(
        array $needle,
        array $arr
    ): bool {
        $c = 0;

        foreach ($needle as $array) {
            $c += (int) in_array($array, $arr) ? 1 : 0;
        }

        return (int) $c === (int) count($needle) ? true : false;
    }

    /**
     * Returns the input CamelCasedString as an underscored_string.
     * 
     * Regular expression copied from <https://github.com/cakephp/cakephp/blob/master/src/Utility/Inflector.php>
     * 
     * @param string $str
     * 
     * @return string
     */
    public static function underscore(
        string $str
    ): string {
        return mb_strtolower(preg_replace('/(?<=\\w)([A-Z])/', "_" . '\\1', $str));
    }

    /**
     * Destroy return in JSON format.
     * 
     * @param bool $status
     * @param int $id
     * @param string $model
     * 
     * @return string
     */
    public static function JSONDestroyString(
        bool $status = true,
        int $id = 0,
        string $model
    ): string {
        return json_encode(self::JSONDestroyArray($status, $id, $model), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    /**
     * Destroy return in Array format.
     * 
     * @param bool $status
     * @param int $id
     * @param string $model
     * 
     * @return array
     */
    public static function JSONDestroyArray(
        bool $status = true,
        int $id = 0,
        string $model
    ): array {
        return [
            'status' => $status,
            'timestamp' => date("Y/m/d H:i:s"),
            "message" => "{$model} #{$id} deleted from system",
            "id" => $id
        ];
    }

    /**
     * Method used to return a random color in hex format.
     *
     * @param void
     * 
     * @return string
     */
    public static function getHEXRandomColor(): string
    {
        return sprintf('#%02x%02x%02x', rand(0, 255), rand(0, 255), rand(0, 255));
    }

    /**
     * Method used to return an array of colors in hexadecimal format.
     * 
     * @param int $n
     * 
     * @return array
     */
    public static function getArrayOfHexColors(
        int $n = 0
    ): array {
        if (
            $n <= 0
        ) {
            throw new InvalidParameterException("The method getArrayOfHexColors expect receive an positive and not null parameter. :{$n} received.");
        }

        return array_map(function () {
            return \App\Helpers\Utils::getHEXRandomColor();
        }, array_fill(NULL, $n, NULL));
    }

    /**
     * It receives a string containing a controller and its namespace and returns the characteristic name of the module in question.
     * 
     * @param string $str
     * 
     * @return string
     */
    public static function ctrlr2string(
        string $str
    ): string {
        return (string) preg_replace('/(App\\\\Http\\\\Controllers\\\\)|(Controller)/', NULL, $str);
    }
}
