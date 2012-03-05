<?php
/**
 * Created by JetBrains PhpStorm.
 * User: francis
 * Date: 2/29/12
 * Time: 10:45 AM
 * To change this template use File | Settings | File Templates.
 */
namespace Processus\Lib\Service\Twitter;
class TwitterService extends \Processus\Abstracts\AbstractClass
{
    /**
     * @var string
     */
    private $_accessToken;

    /**
     * @var string
     */
    private $_userName;

    /**
     * @var \Zend\Service\Twitter
     */
    private $_client;

    /**
     * @param $accessToken
     *
     * @return TwitterService
     */
    public function setAccessToken(\string $accessToken)
    {
        $this->_accessToken = $accessToken;
        return $this;
    }

    /**
     * @param $userName
     *
     * @return TwitterService
     */
    public function setUserName($userName)
    {
        $this->_userName = $userName;
        return $this;
    }

    /**
     * @return \Zend\Rest\Client\Result
     * @throws TwitterServiceException
     */
    public function init()
    {

        if (is_null($this->_userName)) {
            throw new TwitterServiceException("Username is not set!");
        }

        if (is_null($this->_accessToken)) {
            throw new TwitterServiceException("Accesstoken is not set!");
        }

        $this->_client = new \Zend\Service\Twitter(array("username"    => $this->_userName,
                                                         "accessToken" => $this->_accessToken
                                                   ));
        return $this;
    }

    /**
     * @return \Zend\Rest\Client\Result
     */
    public function verify()
    {
        return $this->_client->accountVerifyCredentials();
    }

    /**
     * @return \Zend\Service\Twitter
     */
    public function getTwitterClient()
    {
        if (!$this->_client) {
            throw new TwitterServiceException("Twitter Client not initialize! Please set the uername and accesstoken first and call the init function.");
        }
        return $this->_client;
    }
}
