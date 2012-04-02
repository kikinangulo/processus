<?php
/**
 * Created by JetBrains PhpStorm.
 * User: francis
 * Date: 3/28/12
 * Time: 11:14 PM
 * To change this template use File | Settings | File Templates.
 */
namespace Processus\Lib;
class GoogleAnalyticsDataVo extends \Processus\Abstracts\Vo\AbstractVO
{
    /**
     * @var \UnitedPrototype\GoogleAnalytics\Page
     */
    private $_page;

    /**
     * @var \UnitedPrototype\GoogleAnalytics\Tracker
     */
    private $_tracker;

    /**
     * @var \UnitedPrototype\GoogleAnalytics\Session
     */
    private $_session;
}
