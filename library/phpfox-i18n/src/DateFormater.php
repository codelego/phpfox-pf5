<?php

namespace Phpfox\I18n;

use IntlDateFormatter;


class DateFormater
{
    /**
     * @var string
     */
    protected $locale =  'en_us';

    /**
     * @var string
     */
    protected $full_pattern = 'EEEE, MMMM d, y hh:mm:ss';

    /**
     * @var string
     */
    protected $long_pattern = 'EEEE, MMMM d, y h:mm:ss a zzzz';

    /**
     * @var string
     */
    protected $medium_pattern = 'MMMM d, y hh:mm:ss';

    /**
     * @var string
     */
    protected $short_pattern = 'MMMM d, y hh:mm:ss';

    /**
     * @var string
     */
    protected $timezone = 'GMT';

    /**
     * @var int
     */
    protected $calendar = IntlDateFormatter::GREGORIAN;

    /**
     * @var IntlDateFormatter
     */
    protected $formater;

    /**
     * DateFormater constructor.
     *
     * @param string $locale
     * @param string $full
     * @param string $long
     * @param string $medium
     * @param string $short
     */
    public function __construct($locale, $full = null, $long = null, $medium = null, $short = null)
    {
        $this->locale = $locale;

        if (null != $full) {
            $this->full_pattern = $full;
        }
        if (null != $long){
            $this->long_pattern = $long;
        }
        if (null != $medium) {
            $this->medium_pattern = $medium;
        }

        if (null != $short ) {
            $this->short_pattern = $short;
        }

        $this->formater = new IntlDateFormatter($this->locale, IntlDateFormatter::FULL, IntlDateFormatter::FULL, $this->timezone,$this->calendar);

    }

    /**
     * @param mixed $time date time string
     * @param mixed $type short:3, medium: 2, long: 1, full: 0
     *
     * @return string
     */
    public function format($time, $type)
    {
        if(!preg_match('/^\d+$/', $time)){
            $time = strtotime($time);
        }

        switch ($type) {
            case 3:
            case 'short':
                $this->formater->setPattern($this->short_pattern);
                break;
            case 2:
            case 'medium':
                $this->formater->setPattern($this->medium_pattern);
                break;
            case 1:
            case 'long':
                $this->formater->setPattern($this->long_pattern);
                break;
            case 0:
            case 'full':
            default:
                $this->formater->setPattern($this->full_pattern);
        }

        return (string)$this->formater->format($time);
    }
}