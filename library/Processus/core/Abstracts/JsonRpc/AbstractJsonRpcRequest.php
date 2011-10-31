<?php

    namespace Processus\Abstracts\JsonRpc
    {
        /**
         *
         */
        abstract class AbstractJsonRpcRequest extends \Zend\Json\Server\Request\Http
        {

            /**
             * @var mixed
             */
            protected $_request;

            /**
             * @var string
             */
            protected $_namespace;

            /**
             * @var string
             */
            protected $_domain;

            /**
             * @var string
             */
            protected $_class;

            /**
             * @var string
             */
            protected $_specifiedNamespace;

            // #########################################################

            public function __construct()
            {
                parent::__construct();
                list ($this->_domain, $this->_class, $this->_method) = explode('.', parent::getMethod());
            }

            // #########################################################

            /**
             * @return string
             */
            public function getMethod()
            {
                return $this->_method;
            }

            // #########################################################

            /**
             * @return array
             */
            public function getExtended()
            {
                $rawJSON = $this->getRawJson();
                return $rawJSON['extended'];
            }

            // #########################################################

            /**
             * @return mixed
             */
            public function getNamespace()
            {
                return $this->_namespace;
            }

            // #########################################################

            /**
             * @return mixed
             */
            public function getDomain()
            {
                return $this->_domain;
            }

            // #########################################################

            /**
             * @return string
             */
            public function getFunctionName()
            {
                return $this->_method;
            }

            // #########################################################

            /**
             * @return string
             */
            public function getSpecifiedServiceClassName()
            {
                return $this->getSpecifiedNamespace() . "\\Service\\" . $this->_class;
            }

            // #########################################################

            /**
             * @param $specNs string
             */
            public function setSpecifiedNamespace($specNs)
            {
                $this->_specifiedNamespace = $specNs;
            }

            /**
             * @return string
             */
            public function getSpecifiedNamespace()
            {
                return $this->_specifiedNamespace;
            }

        }
    }

?>