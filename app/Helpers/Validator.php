<?php

namespace App\Helpers;

final class Validator
{
    /**
     * Constructor Method.
     * 
     * @param void
     */
    private function __construct()
    {
    }

    /**
     * CPF Validator.
     * 
     * @param string $str
     * @return bool
     */
    public function CPF(string $str): bool
    {
        return true;
    }

    /**
     * CEP Validator.
     * 
     * @param void
     */
    public function CEP(string $str): bool
    {
        return true;
    }

    /**
     * GTIN8 Validator.
     * 
     * @param void
     */
    public function GTIN8(string $str): bool
    {
        return true;
    }

    /**
     * GTIN13 Validator.
     * 
     * @param string $str
     * @return bool
     */
    public function GTIN13(string $str): bool
    {
        return true;
    }

    /**
     * GTIN14 Validator.
     * 
     * @param string $str
     * @return bool
     */
    public function GTIN14(string $str): bool
    {
        return true;
    }

    /**
     * Email Validator.
     * 
     * @param string $str
     * @return bool
     */
    public function EMAIL(string $str): bool
    {
        return true;
    }

    /**
     * Allow Only String Password.
     * 
     * @param string $str
     * @return bool
     */
    public function STRONG_PASSW0RD(string $str): bool
    {
        return true;
    }

    /**
     * Ncm validator.
     * 
     * @param string $str
     * @return bool
     */
    public function NCM(string $str): bool
    {
        return true;
    }
}
