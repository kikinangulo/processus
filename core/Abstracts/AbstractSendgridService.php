<?php
/**
 * Created by JetBrains PhpStorm.
 * User: francis
 * Date: 3/14/12
 * Time: 12:01 PM
 * To change this template use File | Settings | File Templates.
 */
namespace Processus\Lib\Service\Sendgrid;
abstract class AbstractSendgridService extends \Processus\Abstracts\AbstractClass
{

    /**
     * @var \Zend\Mail\Mail
     */
    protected $_mail;

    /**
     * @var \Zend\Mail\Transport\Smtp
     */
    protected $_transport;

    /**
     * @param string $receiverEmailAddress
     * @param string $bodyHtml
     * @param string $subject
     *
     * @return \Zend\Mail\Mail
     * @throws \Exception
     */
    protected function _sendEmail(\string $receiverEmailAddress, \string $bodyHtml, \string $subject = "AnteUp")
    {
        try {
            $response = $this->_getMailClient()->addTo($receiverEmailAddress)
                ->setSubject($subject)
                ->setBodyHtml($bodyHtml)
                ->send();
        }
        catch (\Exception $error) {
            throw $error;
        }
        return $response;
    }

    /**
     * @return \Zend\Mail\Transport\Smtp
     */
    protected function _getProtocol()
    {
        if (!$this->_transport) {

            /** @var $procConfig \Processus\Abstracts\Vo\AbstractVO */
            $procConfig = $this->getProcessusContext()->getRegistry()
                ->getProcessusConfig()
                ->getSendgridConfig();

            $config = array(
                'auth'     => 'login',
                'username' => $procConfig->getSgCredentials()->getValueByKey("user"),
                'password' => $procConfig->getSgCredentials()->getValueByKey("password"),
            );

            $this->_transport = new \Zend\Mail\Transport\Smtp($procConfig->getSgServerConfig()->getValueByKey(
                "host"
            ), array('port' => $procConfig->getSgServerConfig()->getValueByKey("port")));
            $this->_transport->setConfig($config);

        }

        return $this->_transport;
    }

    /**
     * @return \Zend\Mail\Mail
     */
    protected function _getMailClient()
    {
        if (!$this->_mail) {
            $this->_mail = new \Zend\Mail\Mail();
            $this->_mail->setDefaultTransport($this->_getProtocol());
            $this->_mail->setFrom($this->_getFromEmailAddy(), $this->_getFromEmailName());
        }

        return $this->_mail;
    }

    /**
     * @abstract
     * @return string
     */
    abstract protected function _getFromEmailName();

    /**
     * @abstract
     * @return string
     */
    abstract protected function _getFromEmailAddy();

    /**
     * @param $userRawData
     * @param $sendgridResponse
     */
    protected function _logSendEmail($userRawData, $sendgridResponse)
    {
        $mysql = \Processus\Lib\Db\MySQL::getInstance();

        $insertData = array(
            "email_type"        => $this->_getEmailType(),
            "fb_id"             => $userRawData['id'],
            "email_receiver"    => $userRawData['email'],
            "created"           => time(),
            "sendgrid_response" => json_encode($sendgridResponse),
            "raw_data"          => json_encode($userRawData),
        );

        $mysql->insert($this->_getLogTable(), $insertData);
    }

    /**
     * @return string
     */
    protected function _getLogTable()
    {
        return "log_send_email";
    }

    /**
     * @abstract
     * @return int
     */
    abstract protected function _getEmailType();
}
