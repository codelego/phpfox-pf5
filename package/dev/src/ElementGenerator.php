<?php

namespace Neutron\Dev;


use Neutron\Dev\Model\DevElement;

class ElementGenerator
{
    /**
     * @var array
     */
    protected $params = [];


    /**
     * @var array
     */
    protected $skips = [];

    /**
     * @var array
     */
    protected $moreInfo = [];

    /**
     * ElementGenerator constructor.
     *
     * @param array $params
     */
    public function __construct($params)
    {
        $this->params = $params;
    }

    /**
     * @param DevElement $devElement
     *
     * @return string
     */
    public function convert($devElement)
    {
        $formType = $this->get('formType');

        $textDomain = $this->get('textDomain');

        if (empty($textDomain)) {
            $textDomain = 'null';
        } else {
            $textDomain = '$$' . (string)$textDomain . '$$';
        }

        $name = $devElement->getElementName();
        $label = $devElement->getLabel();

        if ($this->isShortLabel()) {
            if (substr($label, -2) == 'Id') {
                $label = substr($label, 0, strlen($label) - 3);
            }
        }

        $factoryId = $devElement->getFactoryId();
        $isHidden = $factoryId == 'hidden';

        $element = [
            'name'      => $name,
            'factory'   => $factoryId,
            'label'     => $devElement->getLabel(),
            'note'      => $devElement->getNote(),
            'info'      => $devElement->getInfo(),
            'value'     => $devElement->getDefaultValue(),
            'class'     => $devElement->getClassName(),
            'options'   => [],
            'maxlength' => $devElement->getMaxLength(),
            'rows'      => $devElement->getRows(),
            'cols'      => $devElement->getCols(),
            'required'  => $devElement->isRequire() ? '1' : '',
            'readonly'  => $devElement->isReadonly() ? '1' : '',
            'disabled'  => $devElement->isDisabled() ? '1' : '',
            'data-cmd'  => $devElement->getDataCmd(),
        ];


        if ($factoryId == 'radio' and $this->isNoRadio()) {
            $element['decorator'] = 'select';
        } elseif ($factoryId == 'textarea' and $this->isNoTextarea()) {
            $element['decorator'] = 'text';
        }

        if ($isHidden or $this->isNoLabel()) {
            unset($element['label']);
        } elseif ($label) {
            $element['label'] = '$$$_text($$' . $label . '$$,' . $textDomain . ')$$$';
        }

        if ($isHidden or $this->isNoNote()) {
            unset($element['note']);
        } elseif ($element['note']) {
            $element['note'] = '$$$_text($$' . $element['note'] . '$$, ' . $textDomain . ')$$$';
        }

        if ($isHidden or $this->isNoInfo()) {
            unset($element['info']);
        } elseif ($element['info']) {
            $element['info'] = '$$$_text($$' . $element['info'] . '$$, ' . $textDomain . ')$$$';
        }

        if ($isHidden or $this->isNoRequire()) {
            unset($element['required']);
        }

        if ($isHidden or $this->isNoDefault()) {
            unset($element['value']);
        }

        foreach (array_keys($element) as $key) {
            if (empty($element[$key]) and $element[$key] != '0') {
                unset($element[$key]);
            }
        }

        $template = file_get_contents(__DIR__ . '/../assets/form_element.txt');

        $content = _sprintf($template, [
            'element'    => $this->cleanExport($element),
            'name'       => $name,
            'label'      => $label,
            'formType'   => $formType,
            'textDomain' => $textDomain,
        ]);


        return $this->escape($content);
    }

    protected function cleanExport($data)
    {
        $string = var_export($data, true);
        $string = preg_replace('/\d+\s+=>\s+/', '', $string);
        $string = preg_replace('/,\s+/', ', ', $string);
        $string = preg_replace('/\(\s{2,}/', '( ', $string);
        $string = preg_replace('/\s{2,}\)/', ' )', $string);
        $string = preg_replace('/=>\s{2,}/', '=>', $string);


        return $string;
    }

    /**
     * @param string $key
     * @param string $default
     *
     * @return mixed
     */
    public function get($key, $default = null)
    {
        return isset($this->params[$key]) ? $this->params[$key] : $default;
    }

    /**
     * @return bool
     */
    public function isNoDefault()
    {
        return $this->get('noDefault');
    }

    /**
     * @param $string
     *
     * @return string
     */
    public function escape($string)
    {
        return strtr($string, ['\'$$$' => '', '$$$\'' => '', '$$' => '\'', '\\\\' => '\\']);
    }

    /**
     * @return bool
     */
    public function isNoLabel()
    {
        return $this->get('noLabel', false);
    }

    /**
     * @return bool
     */
    public function isNoNote()
    {
        return $this->get('noNote', false);
    }

    /**
     * @return bool
     */
    public function isNoRequire()
    {
        return $this->get('noRequire', false);
    }

    /**
     * @return bool
     */
    public function isNoRadio()
    {
        return $this->get('noRadio', false);
    }

    /**
     * @return bool
     */
    public function isNoTextarea()
    {
        return $this->get('noTextarea', false);
    }

    /**
     * @return bool
     */
    public function isNoTitle()
    {
        return $this->get('noTitle', false);
    }

    /**
     * @return bool
     */
    public function isNoInfo()
    {
        return $this->get('noInfo', false);
    }

    /**
     * @return bool
     */
    public function isShortLabel()
    {
        return $this->get('sortLabel', false);
    }
}