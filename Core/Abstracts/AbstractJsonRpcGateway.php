<?php

namespace Core\Abstracts
{
    use Zend\Json\Server\Server;

    /**
     *
     */
    abstract class AbstractJsonRpcGateway extends Server
    {
        protected $_config;
        protected $_domain;
        protected $_class;
        protected $_method;

        // #########################################################

        /**
         *
         */
        public function getRequest()
        {
            parent::getRequest();
            list($this->_domain, $this->_class, $this->_method) = explode('.', $this->_request->getMethod());
            $this->_request->setMethod($this->_method);
        }


        // #########################################################


        public function run()
        {
            $this->getRequest();
            $this->_run();
        }


        // #########################################################


        protected function _run()
        {
            $server = new Server();

            // Indicate what functionality is available:
            print_r(array($this->_domain, $this->_class, $this->_method, join('\\', array('App', 'JsonRpc', 'v1', $this->_domain, $this->_class))));
            $server->setClass(join('\\', array('App', 'JsonRpc', 'v1', $this->_domain, $this->_class)));

            // Handle the request:
            $server->handle();
        }
    }
}

?>