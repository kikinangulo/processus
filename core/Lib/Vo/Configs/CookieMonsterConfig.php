<?php
/**
 * Created by JetBrains PhpStorm.
 * User: thelittlenerd87
 * Date: 6/19/12
 * Time: 11:40 AM
 * To change this template use File | Settings | File Templates.
 */
namespace Processus\Lib\Vo\Configs;
class CookieMonsterConfig extends \Processus\Abstracts\Vo\AbstractVO
{
    /**
     * @return array|mixed
     */
    public function getPrefix()
    {
        return $this->getValueByKey("prefix");
    }

    /**
     * @return array|mixed
     */
    public function getAppId()
    {
        return $this->getValueByKey("appId");
    }

    /**
     * @return array|mixed
     */
    public function getExpiredTime()
    {
        return $this->getValueByKey("expiredTime");
    }
}
