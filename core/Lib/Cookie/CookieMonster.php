<?php
/**
 * Created by JetBrains PhpStorm.
 * User: thelittlenerd87
 * Date: 6/19/12
 * Time: 11:12 AM
 * To change this template use File | Settings | File Templates.
 */
namespace Processus\Lib\Cookie;
class CookieMonster extends \Processus\Abstracts\AbstractClass
{

    /**
     * @var CookieMonster
     */
    private static $_Instance = NULL;

    /**
     * @static
     * @return null|CookieMonster
     */
    public static function getInstance()
    {
        if (!self::$_Instance) {
            self::$_Instance = new CookieMonster();
        }

        return self::$_Instance;
    }

    /**
     * @param \Processus\Interfaces\InterfaceCookieMonster $cookieData
     *
     * @return bool
     */
    public function storeCookie(\Processus\Interfaces\InterfaceCookieMonster $cookieData)
    {
        if (!$cookieData->getCookieName()) {
            $cookieData->setCookieName($this->getConfig()->getPrefix() . $this->getConfig()->getAppId());
        }

        if (!$cookieData->getExpiredTime()) {
            $cookieData->setExpiredTime($this->getConfig()->getExpiredTime());
        }

        return setcookie($cookieData->getCookieName(), json_encode($cookieData->getCookieData()), $cookieData->getExpiredTime());
    }

    /**
     * @return \Processus\Lib\Vo\Configs\CookieMonsterConfig
     */
    protected function getConfig()
    {
        return $this->getProcessusContext()->getRegistry()->getProcessusConfig()->getCookieMonsterConfig();
    }
}
