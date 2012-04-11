<?php
/**
 * Created by JetBrains PhpStorm.
 * User: francis
 * Date: 4/3/12
 * Time: 8:31 AM
 * To change this template use File | Settings | File Templates.
 */
namespace Processus\Lib\GA;
interface InterfaceGoogleAnalyticsData extends \Processus\Interfaces\InterfaceVo
{

    /**
     * @abstract
     *
     * @param \Processus\Interfaces\InterfaceVo $config
     *
     * @return mixed
     */
    public function setConfig(\Processus\Interfaces\InterfaceVo $config);

    /**
     * @abstract
     * @return \Processus\Interfaces\InterfaceVo
     */
    public function getConfig();

    /**
     * @abstract
     * @return \UnitedPrototype\GoogleAnalytics\Visitor
     */
    public function getVisitor();

    /**
     * @abstract
     * @return \UnitedPrototype\GoogleAnalytics\Tracker
     */
    public function getTracker();

    /**
     * @abstract
     * @return \UnitedPrototype\GoogleAnalytics\Page
     */
    public function getPage();

    /**
     * @abstract
     * @return \UnitedPrototype\GoogleAnalytics\Session
     */
    public function getSession();

}
