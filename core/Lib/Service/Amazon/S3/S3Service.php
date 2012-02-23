<?php
/**
 * Created by JetBrains PhpStorm.
 * User: francis
 * Date: 2/23/12
 * Time: 11:45 AM
 * To change this template use File | Settings | File Templates.
 */
namespace Processus\Lib\Service\Amazon\S3;
class S3Service extends \Processus\Abstracts\AbstractClass
{
    private $_s3Service;

    public function __construct()
    {
        $amazonConfig = $this->getProcessusContext()->getRegistry()->getProcessusConfig()->getAmazonConfig()->getS3Config()->getAuthData();
        //$auth = new \Zend\Service\Amazon\Authentication\S3();

    }
}
