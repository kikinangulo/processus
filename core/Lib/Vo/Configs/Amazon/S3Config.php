<?php
/**
 * Created by JetBrains PhpStorm.
 * User: francis
 * Date: 2/23/12
 * Time: 12:41 PM
 * To change this template use File | Settings | File Templates.
 */
namespace Processus\Lib\Vo\Configs\Amazon;
class S3Config extends \Processus\Abstracts\Vo\AbstractVO
{
    /**
     * @return array|mixed
     */
    public function getAuthData()
    {
        return (array)$this->getValueByKey("auth");
    }
}
