<?php

namespace Processus\Interfaces
{
    /**
     *
     */
    interface InterfaceDatabase
    {
        public function fetch();
        public function fetchOne();
        public function fetchAll();
        /**
         * @abstract
         * @return \Zend\Db\Statement\Pdo
         */
        public function insert();
        /**
         * @abstract
         * @return \Zend\Db\Statement\Pdo
         */
        public function update();
    }
}

?>