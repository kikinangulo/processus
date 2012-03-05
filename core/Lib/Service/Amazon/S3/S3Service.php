<?php
/**
 * Created by JetBrains PhpStorm.
 * User: francis
 * Date: 2/23/12
 * Time: 11:45 AM
 * To change this template use File | Settings | File Templates.
 */
namespace Processus\Lib\Service\Amazon\S3;
class S3Service extends \Processus\Abstracts\AbstractClass implements \Processus\Interfaces\InterfaceDatabase
{
    /**
     * @var \Zend\Service\Amazon\S3\S3
     */
    private $_s3Service;

    /**
     * Constructor
     */
    public function __construct()
    {
        $amazonConfig     = $this->getProcessusContext()->getRegistry()->getProcessusConfig()->getAmazonConfig()->getS3Config()->getAuthData();
        $this->_s3Service = new \Zend\Service\Amazon\S3\S3($amazonConfig['aws_key'], $amazonConfig['secret']);
    }

    /**
     * @return array|false
     */
    public function getBuckets()
    {
        return $this->_s3Service->getBuckets();
    }

    /**
     * @param $objectString
     *
     * @return bool
     */
    public function remove($objectString)
    {
        return $this->_s3Service->removeObject($objectString);
    }

    public function fetch()
    {
        throw new \Processus\Exceptions\NotImplementedException();
    }

    /**
     * @param null|string $objectString
     *
     * @return string|\Zend\Service\Amazon\S3\false
     */
    public function fetchOne(\string $objectString = null)
    {
        return $this->_s3Service->getObject($objectString);
    }

    /**
     * @return array|false
     */
    public function fetchAll()
    {
        return $this->_s3Service->getBuckets();
    }

    /**
     * @param null|string $sourcePath
     * @param null        $object
     * @param null        $metaInfo
     *
     * @return bool
     */
    public function insert(\string $sourcePath = null, $object = null, $metaInfo = null)
    {
        return $this->_s3Service->putFile($sourcePath, $object, $metaInfo);
    }

    /**
     * @return \Zend\Db\Statement\Pdo
     */
    public function update()
    {
        throw new \Processus\Exceptions\NotImplementedException();
    }
}
