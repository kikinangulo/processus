<?php
/**
 * Created by JetBrains PhpStorm.
 * User: francis
 * Date: 2/29/12
 * Time: 10:31 AM
 * To change this template use File | Settings | File Templates.
 */
namespace Processus\Lib\Service\Amazon\S3;
interface IS3
{
    public function uploadFile();

    public function deleteFile();

    public function getBuckets();
}
