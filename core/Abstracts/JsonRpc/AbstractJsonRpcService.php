<?php

/**
 * @author fightbulc
 *
 *
 */
namespace Processus\Abstracts\JsonRpc
{
    abstract class AbstractJsonRpcService extends \Processus\Abstracts\AbstractClass
    {
        /**
         * @param $method
         * @param $request
         * @param $duration
         * @param $metaData
         */
        protected function _logJsonRpc(\string $method, $request, $duration, $metaData)
        {
            $mysql = $this->getProcessusContext()->getMasterMySql();

            $insertData = array(
                "method"    => $method,
                "request"   => json_encode($request),
                "meta_data" => json_encode($metaData),
                "duration"  => $duration,
                "created"   => time(),
            );

            $mysql->insert($this->_getLogTransactionTable(), $insertData);
        }

        /**
         * @return string
         */
        protected function _getLogTransactionTable()
        {
            return "log_json_rpc";
        }
    }
}

?>