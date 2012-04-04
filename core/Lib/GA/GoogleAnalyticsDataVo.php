<?php
/**
 * Created by JetBrains PhpStorm.
 * User: francis
 * Date: 3/28/12
 * Time: 11:14 PM
 * To change this template use File | Settings | File Templates.
 */
namespace Processus\Lib;
class GoogleAnalyticsDataVo extends \Processus\Abstracts\Vo\AbstractVO implements \Processus\Lib\GA\InterfaceGoogleAnalyticsData
{

    /**
     *
     * @param \Processus\Interfaces\InterfaceVo $config
     *
     * @return mixed
     */
    public function setConfig(\Processus\Interfaces\InterfaceVo $config)
    {
        // TODO: Implement setConfig() method.
    }

    /**
     * @return \Processus\Interfaces\InterfaceVo
     */
    public function getConfig()
    {
        // TODO: Implement getConfig() method.
    }

    /**
     * @return \UnitedPrototype\GoogleAnalytics\Visitor
     */
    public function getVisitor()
    {
        // TODO: Implement getVisitor() method.
    }

    /**
     * @return \UnitedPrototype\GoogleAnalytics\Tracker
     */
    public function getTracker()
    {
        // TODO: Implement getTracker() method.
    }

    /**
     * @return \UnitedPrototype\GoogleAnalytics\Page
     */
    public function getPage()
    {
        // TODO: Implement getPage() method.
    }

    /**
     * @return \UnitedPrototype\GoogleAnalytics\Session
     */
    public function getSession()
    {
        // TODO: Implement getSession() method.
    }
}
