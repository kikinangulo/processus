<?php
/**
 * Created by JetBrains PhpStorm.
 * User: francis
 * Date: 3/14/12
 * Time: 1:13 PM
 * To change this template use File | Settings | File Templates.
 */
namespace Processus\Lib\Vo\Configs\Sendgrid;
class SendgridConfig extends \Processus\Abstracts\Vo\AbstractVO
{
    /**
     * @var SendgridAuthor
     */
    private $_sgAuthor;

    /**
     * @var SendgridCredentials
     */
    private $_sgCredentials;

    /**
     * @var SendgridServerConfig
     */
    private $_sgServerConfig;

    /**
     * @return SendgridAuthor
     */
    public function getSgAuthor()
    {
        if (!$this->_sgAuthor) {
            $this->_sgAuthor = new SendgridAuthor();
            $this->_sgAuthor->setData($this->getValueByKey("author"));
        }
        return $this->_sgAuthor;
    }

    /**
     * @return SendgridCredentials
     */
    public function getSgCredentials()
    {
        if (!$this->_sgCredentials) {
            $this->_sgCredentials = new SendgridCredentials();
            $this->_sgCredentials->setData($this->getValueByKey("credentials"));
        }
        return $this->_sgCredentials;
    }

    /**
     * @return SendgridServerConfig
     */
    public function getSgServerConfig()
    {
        if (!$this->_sgServerConfig) {
            $this->_sgServerConfig = new SendgridServerConfig();
            $this->_sgServerConfig->setData($this->getValueByKey("server"));
        }
        return $this->_sgServerConfig;
    }
}
