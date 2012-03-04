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
         * @return array
         */
        public function getApi()
        {
            /** @var $server AbstractJsonRpcServer */
            $server = $this->getProcessusContext()->getBootstrap()->getGateway()->getServer();
            return $server->getServiceMap()->toArray();
        }

        /**
         * @param string $method
         * @param        $request
         * @param        $duration
         * @param        $metaData
         *
         * @return bool|\Zend\Db\Statement\Pdo
         */
        protected function _logJsonRpc(\string $method, $request, $duration, $metaData = null)
        {
            //            if ($this->_getPercentageOfLogging() > 55 && $this->_getPercentageOfLogging() < 100) {
            $mysql = $this->getProcessusContext()->getMasterMySql();

            $insertData = array(
                "method"    => $method,
                "request"   => json_encode($request),
                "meta_data" => json_encode($metaData),
                "duration"  => $duration,
                "created"   => time(),
            );

            return $mysql->insert($this->_getLogTransactionTable(), $insertData);
            //            }

            return FALSE;

        }

        /**
         * @return string
         */
        protected function _getLogTransactionTable()
        {
            return "log_json_rpc";
        }

        /**
         * @return int
         */
        protected function _getPercentageOfLogging()
        {
            return rand(1, 100);
        }
    }
}

?>