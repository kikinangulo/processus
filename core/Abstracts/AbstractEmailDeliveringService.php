<?php
/**
 * Created by JetBrains PhpStorm.
 * User: francis
 * Date: 3/14/12
 * Time: 12:01 PM
 * To change this template use File | Settings | File Templates.
 */
namespace Processus\Lib\Service\Sendgrid;
abstract class AbstractEMailDeliveringService extends \Processus\Abstracts\AbstractClass
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
     * @param        $receiverEmailAddress
     * @param        $bodyHtml
     * @param string $subject
     *
     * @return \Zend\Mail\Mail
     * @throws \Exception
     */
    protected function _sendEmail($receiverEmailAddress, $bodyHtml, $subject = "AnteUp")
    {
        try
        {
            $response = $this->_getMailClient()->addTo($receiverEmailAddress)
                ->setSubject($subject)
                ->setBodyHtml($bodyHtml)
                ->send();
        }
        catch (\Exception $error)
        {
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


            $procConfig = $this->getProcessusContext()->getRegistry()
                ->getProcessusConfig()
                ->getValueByKey("SendGrid");

            $config = array('auth'     => 'login',
                            'username' => 'crowdpark',
                            'password' => 'CrowdPark4Ever'
            );

            $this->_transport = new \Zend\Mail\Transport\Smtp('smtp.sendgrid.net', array('port' => 587));
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
        $table      = "email";

        $mysql->insert($table, $insertData);
    }

    /**
     * @abstract
     * @return int
     */
    abstract protected function _getEmailType();
}
