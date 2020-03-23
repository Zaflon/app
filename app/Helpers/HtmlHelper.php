<?php

namespace App\Helpers;

class Helper
{
    /**
     * Mostra um span.
     */
    public static function span(string $name, array $data = []): void
    {
        if (empty($name) || !is_string($name)) {
            echo '<span style="color: #1860A7;">Please inform a name</span>';
        }

        $class = $data["class"] ?? '';
        $style = $data["style"] ?? '';
        $content = $data["content"] ?? '';
        $id = $data['id'] ?? $name;

        echo "<span name = {$name} id = {$id} class = \"{$class}\" style = \"{$style}\"> {$content} </span>";
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
}
