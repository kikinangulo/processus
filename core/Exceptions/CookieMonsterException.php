<?php
/**
 * Created by JetBrains PhpStorm.
 * User: thelittlenerd87
 * Date: 6/19/12
 * Time: 4:41 PM
 * To change this template use File | Settings | File Templates.
 */
namespace Processus\Exceptions;
class CookieMonsterException extends ProcessusException
{
    public function __construct($message = "", $code = 1000, $severity = 10, $filename = __FILE__, $lineno = __LINE__, $previous = array())
    {
        parent::__construct("Cookie not found!", $code, $severity, $filename, $lineno, $previous);
    }
}
