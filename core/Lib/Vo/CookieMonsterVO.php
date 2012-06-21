<?php
/**
 * Created by JetBrains PhpStorm.
 * User: thelittlenerd87
 * Date: 6/19/12
 * Time: 11:24 AM
 * To change this template use File | Settings | File Templates.
 */
namespace Processus\Lib\Vo;
class CookieMonsterVO extends \Processus\Abstracts\Vo\AbstractVO implements \Processus\Interfaces\InterfaceCookieMonster
{

    /**
     *
     * @param $name
     *
     * @return \Processus\Interfaces\InterfaceCookieMonster
     */
    public function setCookieName($name)
    {
        $this->setValueByKey("cookieName", $name);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCookieName()
    {
        return $this->getValueByKey("cookieName");
    }

    /**
     *
     * @param $data
     *
     * @return \Processus\Interfaces\InterfaceCookieMonster
     */
    public function setCookieData($data)
    {
        $this->setValueByKey("coookieData", $data);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCookieData()
    {
        return $this->getValueByKey("coookieData");
    }

    /**
     *
     * @param $expiredTime
     *
     * @return \Processus\Interfaces\InterfaceCookieMonster
     */
    public function setExpiredTime($expiredTime)
    {
        $this->setValueByKey('expiredTime', $expiredTime);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getExpiredTime()
    {
        return $this->getValueByKey('expiredTime');
    }

    /**
     *
     * @param $hashAlgo
     *
     * @return \Processus\Interfaces\InterfaceCookieMonster
     */
    public function setHashAlgo($hashAlgo)
    {
        $this->setValueByKey("hashAlgo", $hashAlgo);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHashAlgo()
    {
        return $this->getValueByKey("hashAlgo");
    }

    /**
     *
     * @param $domain
     *
     * @return \Processus\Interfaces\InterfaceCookieMonster
     */
    public function setDomain($domain)
    {
        $this->setValueByKey("domain", $domain);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDomain()
    {
        return $this->getValueByKey("domain");
    }

    /**
     *
     * @param $value
     *
     * @return \Processus\Interfaces\InterfaceCookieMonster
     */
    public function setSSLOnly($value)
    {
        // TODO: Implement setSSLOnly() method.
    }

    /**
     * @return mixed
     */
    public function getSSLOnly()
    {
        // TODO: Implement getSSLOnly() method.
    }
}
