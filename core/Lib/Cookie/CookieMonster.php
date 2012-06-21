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
    public function eatCookie(\Processus\Interfaces\InterfaceCookieMonster $cookieData)
    {
        if (!$cookieData->getCookieName()) {
            $cookieData->setCookieName($this->getConfig()->getPrefix() . $this->getConfig()->getAppId());
        }

        if (!$cookieData->getExpiredTime()) {
            $cookieData->setExpiredTime($this->getConfig()->getExpiredTime());
        }

        return setrawcookie($cookieData->getCookieName(), base64_encode(json_encode($cookieData->getCookieData())), $cookieData->getExpiredTime(), NULL, "." . \Processus\Lib\Server\ServerInfo::getInstance()->getHttpHost());
    }

    /**
     * @param $cookieKey
     *
     * @return mixed
     */
    public function pukeCookie($cookieKey)
    {
        $cookieRawData = $_COOKIE[$cookieKey];

        if (!$cookieRawData) {
            throw new \Processus\Exceptions\CookieMonsterException();
        }

        $cookieData = array();

        try {
            $base64Data = base64_decode($cookieRawData);
            var_dump($base64Data);
            $cookieData = json_decode(json_decode($base64Data), TRUE);
        } catch (\Exception $error) {
            var_dump($error);
        }
        return $cookieData;
    }

    /**
     * @return \Processus\Lib\Vo\Configs\CookieMonsterConfig
     */
    protected function getConfig()
    {
        return $this->getProcessusContext()->getRegistry()->getProcessusConfig()->getCookieMonsterConfig();
    }
}
