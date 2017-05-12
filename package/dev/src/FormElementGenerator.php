<?php

namespace Neutron\Dev;

use Neutron\Dev\Model\DevAction;

class FormElementGenerator
{
    /**
     * @var DevAction
     */
    protected $meta;

    /**
     * @var array
     */
    protected $params;

    /**
     * @var array
     */
    protected $skips = [];

    /**
     * @var array
     */
    protected $moreInfo = [];

    /**
     * FormElement constructor.
     *
     * @param DevAction $meta
     * @param array     $params
     */
    public function __construct($meta, $params = [])
    {
        $this->meta = $meta;
        $this->params = $params;

        $this->skips = include(__DIR__ . '/../assets/skip_elements.php');
        $this->moreInfo = include(__DIR__ . '/../assets/element_meta.php');
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
     * @param ColumnInfo $column
     *
     * @return string
     */
    public function convert(ColumnInfo $column)
    {
        $textDomain = $this->meta->getTextDomain();
        $formType = $this->get('formType');

        if (empty($textDomain)) {
            $textDomain = 'null';
        } else {
            $textDomain = '$$' . (string)$textDomain . '$$';
        }

        $name = $column->getName();
        $label = $column->getLabel();

        if ($this->isShortLabel()) {
            if (substr($label, -2) == 'Id') {
                $label = substr($label, 0, strlen($label) - 3);
            }
        }

        $element = [
            'name'      => $name,
            'factory'   => 'text',
            'label'     => '',
            'note'      => '',
            'value'     => $column->getDefault(),
            'options'   => [],
            'maxlength' => '',
            'rows'      => '',
            'cols'      => '',
            'readonly'  => '',
            'disabled'  => '',
        ];

        if ($column->isString()) {
            $element['factory'] = $column->isMultiLine() && !$this->isNoTextarea() ? 'textarea' : 'text';
            $element['maxlength'] = $column->getLength();
        } elseif ($column->isBoolean()) {
            if ($this->isNoRadio()) {
                $element['factory'] = 'select';
                $element['options'] = [
                    ['value' => 1, 'label' => 'Yes'],
                    ['value' => 0, 'label' => 'No'],
                ];
            } else {
                $element['factory'] = 'yesno';
            }
        } elseif ($column->isNumber()) {
            $element['factory'] = 'text';
            $element['maxlength'] = $column->getLength();
        }

        if (array_key_exists($name, $this->moreInfo)) {
            $element = array_merge($element, $this->moreInfo[$name]);
        }

        $element['label'] = '$$$_text($$' . $label . '$$,' . $textDomain . ')$$$';
        $element['note'] = '$$$_text($$[' . $label . ' Note]$$, ' . $textDomain . ')$$$';

        $element['required'] = $column->isRequired();

        if (in_array($name, $this->skips)) {
            return '/** skip element `' . $name . '` #skips **/';
        }

        if ($this->isNoNote()) {
            unset($element['note']);
        }

        if ($this->isNoLabel()) {
            unset($element['label']);
        }

        if ($this->isNoRequire()) {
            unset($element['required']);
        }

        if ($this->isNoDefault()) {
            unset($element['value']);
        }

        if ($column->isIdentity()) {
            return '/** skip element `' . $name . '` #identity **/';
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