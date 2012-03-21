<?php
/**
 * Created by JetBrains PhpStorm.
 * User: francis
 * Date: 2/23/12
 * Time: 12:41 PM
 * To change this template use File | Settings | File Templates.
 */
namespace Processus\Lib\Vo\Configs\Amazon;
class AmazonConfig extends \Processus\Abstracts\Vo\AbstractVO
{
    /**
     * @var S3Config
     */
    private $_s3Config;

    /**
     * @return S3Config
     */
    public function getS3Config()
    {
        if (!$this->_s3Config) {
            $this->_s3Config = new S3Config();
            $this->_s3Config->setData("S3");
        }

        return $this->_s3Config;
    }
}
