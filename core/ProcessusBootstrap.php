<?php

namespace Processus
{

    require_once 'helpers.php';

    /**
     *
     */
    class ProcessusBootstrap implements \Processus\Interfaces\InterfaceBootstrap
    {

        /**
         * @var \Processus\ProcessusContext
         */
        private $_applicationContext;

        /**
         * @var array
         */
        private $_errorStack = array();

        /**
         * @return ProcessusContext
         */
        public function getApplication()
        {
            if (!$this->_applicationContext) {
                $this->_applicationContext = new ProcessusContext();
                \Processus\Lib\Profiler\ProcessusProfiler::getInstance()->applicationProfilerStart();
            }
            return $this->_applicationContext;
        }

        /**
         * Initializes the system
         *
         * @param string $mode the mode for which to initialize
         *
         * @return boolean true on success
         *
         */
        public function init($mode = 'DEFAULT')
        {
            try {

                define('PATH_ROOT', realpath(dirname(__FILE__) . '/../../../'));
                define('PATH_CORE', PATH_ROOT . '/library/Processus/core');
                define('PATH_APP', PATH_ROOT . '/application/php');
                define('PATH_PUBLIC', PATH_ROOT . '/htdocs');

                // setup autoloader
                spl_autoload_register(array(
                                           $this,
                                           '_autoLoad'
                                      ));

                // display erros for the following part
                ini_set('display_errors', 'On');

                error_reporting(E_ALL | E_STRICT);

                set_error_handler(array(
                                       $this,
                                       'handleError'
                                  ));

                register_shutdown_function(array(
                                                $this,
                                                'handleError'
                                           ));

                set_exception_handler(array(
                                           $this,
                                           'handleError'
                                      ));

                //ini_set('display_errors', 'Off');

                // cache current include path
                $cachedIncludePath = get_include_path();

                $registry = $this->getApplication()->getRegistry();

                // setup locale
                setlocale(LC_ALL, $registry->getConfig('locale')->default->lc_all);
                date_default_timezone_set($registry->getConfig('locale')->default->timezone);

                // adjustments for different envs (etc. phpunit)
                switch ($mode) {
                    case 'INSTALL':
                        break;

                    case 'TEST':
                        set_include_path(get_include_path() . PATH_SEPARATOR . $cachedIncludePath);

                        break;

                    case 'TASK':
                        break;

                    case 'DEFAULT':
                        break;

                    default:
                        break;
                }

                return true;

            }
            catch (\Exception $e)
            {
                echo json_encode($e);
                exit;
            }
        }

        /**
         * @static
         *
         * @param $className
         *
         * @throws \Zend\Di\Exception\ClassNotFoundException
         */
        public function _autoLoad($className)
        {
            $rootPath = NULL;

            $pathParts = explode('\\', $className);

            switch ($pathParts[0]) {

                case 'Application':
                    $rootPath = PATH_APP;
                    break;

                case 'Processus':
                    $rootPath = PATH_CORE;
                    array_shift($pathParts);
                    break;

                default:
                    $rootPath = PATH_CORE;
                    array_unshift($pathParts, 'Contrib');
                    break;
            }

            $classFile = $rootPath . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $pathParts) . '.php';

            if (!file_exists($classFile)) {
                throw new \Zend\Di\Exception\ClassNotFoundException('Class not found!');
            }

            require_once $classFile;
        }

        /**
         * @param $erroObj
         *
         * @return mixed
         */
        public function handleError($erroObj)
        {
            $lastError  = error_get_last();
            $errorLevel = error_reporting();

            $returnValue           = array();
            $returnValue['result'] = array();
            $returnValue['error']  = array();

            if ($erroObj instanceof \Processus\Abstracts\AbstractException) {

                header('HTTP/1.1 500 Internal Server Error');

                $debug = array();
                $user  = array();

                $debug['trigger']      = "Manual Exception";
                $debug['file']         = $erroObj->getFile();
                $debug['line']         = $erroObj->getLine();
                $debug['message']      = $erroObj->getMessage();
                $debug['trace']        = $erroObj->getTraceAsString();
                $debug['method']       = $erroObj->getMethod();
                $debug['extendedData'] = $erroObj->getExtendData();

                $user['message'] = $erroObj->getUserMessage();
                $user['title']   = $erroObj->getUserMessageTitle();
                $user['code']    = $erroObj->getUserErrorCode();
                $user['details'] = $erroObj->getUserDetailError();

                $lastError['data'] = $lastError;

                $error['debug'] = $debug;

                $error['user']      = $user;
                $error['lasterror'] = $lastError;

                $returnValue['error'] = $error;

                $this->getApplication()->getErrorLogger()->log(var_export($returnValue, true), 1);

                echo json_encode($returnValue);
                return;
            }

            if ($lastError) {

                header('HTTP/1.1 500 Internal Server Error');

                $returnValue        = array();
                $error['trigger']   = "Auto Exception";
                $error['backtrace'] = debug_backtrace();
                $error['errorData'] = $lastError;
                $error['params']    = $erroObj;

                $returnValue['error'] = $error;

                $this->getApplication()->getErrorLogger()->log(var_export($error, true), 1, $error);

                echo json_encode($returnValue);
                return;
            }
        }
    }
}
