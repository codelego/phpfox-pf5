<?php

namespace Phpfox\Logger;


class LogLevelTest extends \PHPUnit_Framework_TestCase
{
    public function testEmergency()
    {
        $this->assertSame(LogLevel::EMERGENCY_NUMBER,
            LogLevel::getNumber('emergency'));
        $this->assertSame(LogLevel::EMERGENCY_NUMBER, LogLevel::getNumber(1));
        $this->assertSame(LogLevel::EMERGENCY_NUMBER, LogLevel::getNumber('1'));
    }

    public function testInfo()
    {
        $this->assertSame(LogLevel::INFO_NUMBER,
            LogLevel::getNumber('info'));
        $this->assertSame(LogLevel::INFO_NUMBER, LogLevel::getNumber(7));
        $this->assertSame(LogLevel::INFO_NUMBER, LogLevel::getNumber('7'));
    }

    public function testAlert()
    {
        $this->assertSame(LogLevel::ALERT_NUMBER,
            LogLevel::getNumber('alert'));
        $this->assertSame(LogLevel::ALERT_NUMBER, LogLevel::getNumber(2));
        $this->assertSame(LogLevel::ALERT_NUMBER, LogLevel::getNumber('2'));
    }

    public function testCRITICAL()
    {
        $this->assertSame(LogLevel::CRITICAL_NUMBER,
            LogLevel::getNumber('critical'));
        $this->assertSame(LogLevel::CRITICAL_NUMBER, LogLevel::getNumber(3));
        $this->assertSame(LogLevel::CRITICAL_NUMBER, LogLevel::getNumber('3'));

    }

    public function testError()
    {
        $this->assertSame(LogLevel::ERROR_NUMBER,
            LogLevel::getNumber('error'));
        $this->assertSame(LogLevel::ERROR_NUMBER, LogLevel::getNumber(4));
        $this->assertSame(LogLevel::ERROR_NUMBER, LogLevel::getNumber('4'));

    }

    public function testWarning()
    {
        $this->assertSame(LogLevel::WARNING_NUMBER,
            LogLevel::getNumber('warning'));
        $this->assertSame(LogLevel::WARNING_NUMBER, LogLevel::getNumber(5));
        $this->assertSame(LogLevel::WARNING_NUMBER, LogLevel::getNumber('5'));
    }

    public function testNotice()
    {
        $this->assertSame(LogLevel::NOTICE_NUMBER,
            LogLevel::getNumber('notice'));
        $this->assertSame(LogLevel::NOTICE_NUMBER, LogLevel::getNumber(6));
        $this->assertSame(LogLevel::NOTICE_NUMBER, LogLevel::getNumber('6'));
    }

    public function testDebug()
    {
        $this->assertSame(LogLevel::DEBUG_NUMBER,
            LogLevel::getNumber('debug'));
        $this->assertSame(LogLevel::DEBUG_NUMBER, LogLevel::getNumber(8));
        $this->assertSame(LogLevel::DEBUG_NUMBER, LogLevel::getNumber('8'));
    }

    public function testDefaultValue()
    {
        $this->assertSame(LogLevel::ERROR_NUMBER,
            LogLevel::getNumber('any value'));
    }
}

