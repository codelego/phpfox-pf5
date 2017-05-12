<?php

namespace Phpfox\Logger;

class ErrorHandler
{
    /**
     * @var integer
     */
    private $_errorReporting;

    /**
     * @var string
     */
    protected $_errorCode;

    /**
     * @var bool
     */
    protected $registered = false;

    /**
     * ErrorHandler constructor.
     */
    public function __construct()
    {
        $this->_errorReporting = E_ALL;
    }

    /**
     * Register error handler
     */
    public function register()
    {
        if ($this->registered) {
            return;
        }

        $this->registered = true;

        set_error_handler([$this, 'handleError']);
        set_exception_handler([$this, 'handleException']);
    }

    /**
     * Error handler
     *
     * @param integer $no
     * @param string  $str
     * @param string  $file
     * @param integer $line
     * @param array   $ctx
     *
     * @return bool
     */
    public function handleError(
        $no,
        $str,
        $file = null,
        $line = null,
        $ctx = null
    ) {
        // Force fatal errors to get reported
        $reporting = error_reporting() | $this->_errorReporting;
        $fatal = false;
        $level = LogLevel::WARNING;

        if ($reporting & $no) {
            switch ($no) {
                case E_COMPILE_ERROR:
                case E_CORE_ERROR:
                case E_ERROR:
                case E_PARSE:
                case E_RECOVERABLE_ERROR:
                case E_USER_ERROR:
                    $level = LogLevel::ERROR;
                    $fatal = true;
                    break;
                case E_USER_NOTICE:
                case E_NOTICE:
                    $level = LogLevel::NOTICE;
                    break;
            }
            $this->getErrorCode(true);
            $message = sprintf(
                '[%1$d] %2$s (%3$s) [%4$d]' . PHP_EOL . '%5$s',
                $no,
                $str,
                $file,
                $line,
                $this->formatBacktrace(array_slice(debug_backtrace(), 1)));


            _service('main.log')->log($level, $message);

        }

        // Handle fatal with nice response for user
        if ($fatal and !PHPFOX_UNIT_TEST) {
            $this->_sendFatalResponse();
        }

        return true;
    }

    /**
     * Exception handler
     *
     * @param \Exception $exception
     *
     * @return bool
     */
    public function handleException($exception)
    {
        $message = 'Error Code: ' . $this->getErrorCode(true) . PHP_EOL .
            $exception->__toString();

        _service('main.log')->error($message);

        if (!PHPFOX_UNIT_TEST) {
            $this->_sendFatalResponse();
        }


        return true;
    }

    public function formatBacktrace($backtrace)
    {
        $output = '';
        $output .= 'Error Code: ' . self::getErrorCode() . PHP_EOL;
        $output .= 'Stack trace:' . PHP_EOL;
        $index = 0;
        foreach ($backtrace as $index => $stack) {
            // Process args
            $args = [];
            if (!empty($stack['args'])) {
                foreach ($stack['args'] as $argIndex => $argValue) {
                    if (is_object($argValue)) {
                        $args[$argIndex] = get_class($argValue);
                    } else {
                        if (is_array($argValue)) {
                            $args[$argIndex]
                                = 'Array'; //substr(print_r($argValue, true), 0, 32);
                        } else {
                            if (is_string($argValue)) {
                                $args[$argIndex] = "'" . substr($argValue, 0,
                                        32) . (strlen($argValue) > 32 ? '...'
                                        : '') . "'";
                            } else {
                                $args[$argIndex] = print_r($argValue, true);
                            }
                        }
                    }
                }
            }
            // Process message
            $output .= sprintf(
                '#%1$d %2$s(%3$d): %4$s%5$s%6$s(%7$s)',
                $index,
                (!empty($stack['file']) ? $stack['file'] : '(unknown file)'),
                (!empty($stack['line']) ? $stack['line'] : '(unknown line)'),
                (!empty($stack['class']) ? $stack['class'] : ''),
                (!empty($stack['type']) ? $stack['type'] : ''),
                $stack['function'],
                join(', ', $args)
            );
            $output .= PHP_EOL;
        }

        // Throw main in there for the hell of it
        $output .= sprintf('#%1$d {main}', $index + 1);

        return $output . PHP_EOL;
    }

    private function _sendFatalResponse()
    {
        while (ob_get_level()) {
            ob_get_clean();
        }
        exit('error_code ' . $this->getErrorCode());
    }

    /**
     * Creates a random error code
     *
     * @param bool $reset
     *
     * @return string
     */
    public function getErrorCode($reset = false)
    {
        if ($reset === true || $this->_errorCode == null) {
            $code = md5(uniqid('', true));
            $this->_errorCode = substr($code, 0, 2)
                . substr($code, 15, 2)
                . substr($code, 30, 2);
        }
        return $this->_errorCode;
    }
}