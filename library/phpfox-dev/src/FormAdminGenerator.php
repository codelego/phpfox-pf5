<?php

namespace Phpfox\RapidDev;


class FormAdminGenerator extends AbstractGenerator
{
    protected $category = 'Form';

    /**
     * @return string
     */
    public function getNameSpace()
    {
        return 'Neutron\\' . _inflect($this->packageId) . '\\Form\\Admin\\'. $this->getComponent();
    }

    protected function initialized()
    {
        // fix text domain
        if (!$this->textDomain) {
            $domains = $this->readSettings('text_domains');
            if (isset($domains[$this->tableName])) {
                $this->textDomain = $domains[$this->tableName];
            }
        } else {
            $this->writeSettings('text_domains', [
                $this->tableName => $this->textDomain,
            ]);
        }
    }

    public function fixTab($number, $content)
    {
        $pad = str_pad('', $number, ' ');

        $lines = explode(PHP_EOL, $content);
        foreach ($lines as $index => $line) {
            $lines[$index] = $pad . $line;
        }
        return implode(PHP_EOL, $lines);
    }
}