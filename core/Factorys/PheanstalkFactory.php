<?php
/**
 * Created by JetBrains PhpStorm.
 * User: francis
 * Date: 12/7/11
 * Time: 11:07 AM
 * To change this template use File | Settings | File Templates.
 */
namespace Processus\Factorys;
class PheanstalkFactory
{
    /**
     * @var array
     */
    private static $_factoryCollection = array();

    /**
     * @static
     * @return array
     */
    public static function getFactoryCollection()
    {
        return self::$_factoryCollection;
    }

    /**
     * @static
     *
     * @param $host
     * @param $port
     *
     * @return \Pheanstalk\Pheanstalk
     */
    public static function factory($host, $port)
    {
        $factoryKey = md5($host . $port);
        $client     = self::$_factoryCollection[$factoryKey];

        if (!$client) {

            $client                                = new \Pheanstalk\Pheanstalk($host, $port);
            self::$_factoryCollection[$factoryKey] = $client;
        }

        return self::$_factoryCollection[$factoryKey];
    }
}