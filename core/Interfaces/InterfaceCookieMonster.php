<?php
/**
 * Created by JetBrains PhpStorm.
 * User: thelittlenerd87
 * Date: 6/19/12
 * Time: 11:09 AM
 * To change this template use File | Settings | File Templates.
 */
namespace Processus\Interfaces;
interface InterfaceCookieMonster extends InterfaceVo
{
    /**
     * @abstract
     *
     * @param $name
     *
     * @return \Processus\Interfaces\InterfaceCookieMonster
     */
    public function setCookieName($name);

    /**
     * @abstract
     * @return mixed
     */
    public function getCookieName();

    /**
     * @abstract
     *
     * @param $data
     *
     * @return \Processus\Interfaces\InterfaceCookieMonster
     */
    public function setCookieData($data);

    /**
     * @abstract
     * @return mixed
     */
    public function getCookieData();

    /**
     * @abstract
     *
     * @param $expiredTime
     *
     * @return \Processus\Interfaces\InterfaceCookieMonster
     */
    public function setExpiredTime($expiredTime);

    /**
     * @abstract
     * @return mixed
     */
    public function getExpiredTime();

    /**
     * @abstract
     *
     * @param $hashAlgo
     *
     * @return \Processus\Interfaces\InterfaceCookieMonster
     */
    public function setHashAlgo($hashAlgo);

    /**
     * @abstract
     * @return mixed
     */
    public function getHashAlgo();

    /**
     * @abstract
     *
     * @param $domain
     *
     * @return \Processus\Interfaces\InterfaceCookieMonster
     */
    public function setDomain($domain);

    /**
     * @abstract
     * @return mixed
     */
    public function getDomain();

    /**
     * @abstract
     *
     * @param $value
     *
     * @return \Processus\Interfaces\InterfaceCookieMonster
     */
    public function setSSLOnly($value);

    /**
     * @abstract
     * @return mixed
     */
    public function getSSLOnly();
}
