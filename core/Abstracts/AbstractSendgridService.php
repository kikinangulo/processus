<?php
/**
 * Created by JetBrains PhpStorm.
 * User: francis
 * Date: 3/14/12
 * Time: 12:01 PM
 * To change this template use File | Settings | File Templates.
 */
namespace Processus\Abstracts;
abstract class AbstractSendgridService extends \Processus\Abstracts\Vo\AbstractVO
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
     * @param $receiverEmailAddress
     * @param $bodyHtml
     * @param $subject
     *
     * @return array|\Zend\Mail\Mail
     * @throws \Exception
     */
    protected function _sendEmail($receiverEmailAddress, $bodyHtml, $subject)
    {
        $response = array();

        try {
            $response = $this->_getMailClient()->addTo($receiverEmailAddress)
                ->setSubject($subject)
                ->setBodyHtml($bodyHtml)
                ->send();

            $userData             = array();
            $userData['email']    = $receiverEmailAddress;
            $userData['bodyHtml'] = $bodyHtml;
            $userData['subject']  = $subject;
            $this->_logSendEmail($userData, $response);
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
            $procConfig = $this->getProcessusContext()->getRegistry()->getSendgridConfig();

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
            "fb_id"             => 0,
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
        return "log_email_send";
    }

    /**
     * @abstract
     * @return int
     */
    abstract protected function _getEmailType();
}
