<?php

namespace Phpfox\RapidDev;

class FormElement
{

    /**
     * @var array
     */
    protected $skips = [];

    /**
     * @var array
     */
    protected $moreInfo = [];

    /**
     * @var string
     */
    protected $formType;

    /**
     * @var string
     */
    protected $tableName;

    /**
     * @var string
     */
    protected $textDomain;

    /**
     * @var bool
     */
    protected $formFilter = false;

    /**
     * @var bool
     */
    protected $formAdd = false;

    /**
     * @var bool
     */
    protected $formEdit = false;

    /**
     * @var bool
     */
    protected $noLabel = false;

    /**
     * @var bool
     */
    protected $noNote = false;

    /**
     * @var bool
     */
    protected $noRequire = false;

    /**
     * @var bool
     */
    protected $noRadio = false;

    /**
     * @var bool
     */
    protected $noTextarea = false;

    /**
     * @var bool
     */
    protected $noTitle = false;

    /**
     * @var bool
     */
    protected $noInfo = false;

    /**
     * @var bool
     */
    protected $shortLabel = false;

    /**
     * @return bool
     */
    public function isNoDefault()
    {
        return $this->noDefault;
    }

    /**
     * @param bool $noDefault
     */
    public function setNoDefault($noDefault)
    {
        $this->noDefault = $noDefault;
    }

    /**
     * @var bool
     */
    protected $noDefault = false;

    /**
     * FormElement constructor.
     *
     * @param array $meta
     */
    public function __construct($meta)
    {
        $this->skips = include(__DIR__ . '/../assets/skip_elements.php');
        $this->moreInfo = include(__DIR__ . '/../assets/element_meta.php');

        foreach ($meta as $key => $value) {
            if (method_exists($this, $method_name = 'set' . ucfirst($key))) {
                $this->{$method_name}($value);
            }
        }
    }


    /**
     * @param ColumnInfo $column
     *
     * @return string
     */
    public function convert(ColumnInfo $column)
    {
        $textDomain = $this->textDomain;
        $formType = $this->formType;

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
            return '// skip element `' . $name . '` #skips';
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
            return '// skip element `' . $name . '` #identity';
        }

        foreach (array_keys($element) as $key) {
            if (empty($element[$key]) and $element[$key] != '0') {
                unset($element[$key]);
            }
        }

        $template = file_get_contents(__DIR__ . '/../assets/form_element.txt');

        $content = _sprintf($template, [
            'element'    => var_export($element, true),
            'name'       => $name,
            'label'      => $label,
            'formType'   => $formType,
            'textDomain' => $textDomain,
        ]);


        return $this->escape($content);
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
     * @return array
     */
    public function getSkips()
    {
        return $this->skips;
    }

    /**
     * @param array $skips
     */
    public function setSkips($skips)
    {
        $this->skips = $this->skips + $skips;
    }

    /**
     * @return array
     */
    public function getMoreInfo()
    {
        return $this->moreInfo;
    }

    /**
     * @param array $moreInfo
     */
    public function setMoreInfo($moreInfo)
    {
        $this->moreInfo = $moreInfo;
    }

    /**
     * @return string
     */
    public function getFormType()
    {
        return $this->formType;
    }

    /**
     * @param string $formType
     */
    public function setFormType($formType)
    {
        $this->formType = $formType;
    }

    /**
     * @return string
     */
    public function getTableName()
    {
        return $this->tableName;
    }

    /**
     * @param string $tableName
     */
    public function setTableName($tableName)
    {
        $this->tableName = $tableName;
    }

    /**
     * @return string
     */
    public function getTextDomain()
    {
        return $this->textDomain;
    }

    /**
     * @param string $textDomain
     */
    public function setTextDomain($textDomain)
    {
        $this->textDomain = $textDomain;
    }

    /**
     * @return bool
     */
    public function isFormFilter()
    {
        return $this->formFilter;
    }

    /**
     * @param bool $formFilter
     */
    public function setFormFilter($formFilter)
    {
        $this->formFilter = $formFilter;
    }

    /**
     * @return bool
     */
    public function isFormAdd()
    {
        return $this->formAdd;
    }

    /**
     * @param bool $formAdd
     */
    public function setFormAdd($formAdd)
    {
        $this->formAdd = $formAdd;
    }

    /**
     * @return bool
     */
    public function isFormEdit()
    {
        return $this->formEdit;
    }

    /**
     * @param bool $formEdit
     */
    public function setFormEdit($formEdit)
    {
        $this->formEdit = $formEdit;
    }

    /**
     * @return bool
     */
    public function isNoLabel()
    {
        return $this->noLabel;
    }

    /**
     * @param bool $noLabel
     */
    public function setNoLabel($noLabel)
    {
        $this->noLabel = $noLabel;
    }

    /**
     * @return bool
     */
    public function isNoNote()
    {
        return $this->noNote;
    }

    /**
     * @param bool $noNote
     */
    public function setNoNote($noNote)
    {
        $this->noNote = $noNote;
    }

    /**
     * @return bool
     */
    public function isNoRequire()
    {
        return $this->noRequire;
    }

    /**
     * @param bool $noRequire
     */
    public function setNoRequire($noRequire)
    {
        $this->noRequire = $noRequire;
    }

    /**
     * @return bool
     */
    public function isNoRadio()
    {
        return $this->noRadio;
    }

    /**
     * @param bool $noRadio
     */
    public function setNoRadio($noRadio)
    {
        $this->noRadio = $noRadio;
    }

    /**
     * @return bool
     */
    public function isNoTextarea()
    {
        return $this->noTextarea;
    }

    /**
     * @param bool $noTextarea
     */
    public function setNoTextarea($noTextarea)
    {
        $this->noTextarea = $noTextarea;
    }

    /**
     * @return bool
     */
    public function isNoTitle()
    {
        return $this->noTitle;
    }

    /**
     * @param bool $noTitle
     */
    public function setNoTitle($noTitle)
    {
        $this->noTitle = $noTitle;
    }

    /**
     * @return bool
     */
    public function isNoInfo()
    {
        return $this->noInfo;
    }

    /**
     * @param bool $noInfo
     */
    public function setNoInfo($noInfo)
    {
        $this->noInfo = $noInfo;
    }

    /**
     * @return bool
     */
    public function isShortLabel()
    {
        return $this->shortLabel;
    }

    /**
     * @param bool $shortLabel
     */
    public function setShortLabel($shortLabel)
    {
        $this->shortLabel = $shortLabel;
    }
}