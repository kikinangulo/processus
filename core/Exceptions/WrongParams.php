<?php
/**
 * Created by JetBrains PhpStorm.
 * User: francis
 * Date: 11/17/11
 * Time: 4:58 PM
 * To change this template use File | Settings | File Templates.
 */
namespace Processus\Exception
{
    class WrongParams extends \Processus\Abstracts\AbstractException
    {

        /**
         * @return string
         */
        public function getMessage()
        {
            return "Wrong params!";
        }
    }
}