<?php

namespace Phpfox\RapidDev;


class ColumnInfo
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $length = 255;

    /**
     * @var bool
     */
    protected $multi_line = false;

    /**
     * @var bool
     */
    protected $identity = false;

    /**
     * @var bool
     */
    protected $primary = false;

    /**
     * @var bool
     */
    protected $unsigned = false;

    /**
     * @var bool
     */
    protected $shortLabel = false;

    /**
     * @var mixed
     */
    protected $_default;

    /**
     * @return bool
     */
    public function isAllowNull()
    {
        return $this->allowNull;
    }

    /**
     * @param bool $allowNull
     */
    public function setAllowNull($allowNull)
    {
        $this->allowNull = $allowNull;
    }

    /**
     * @var bool
     */
    protected $allowNull = false;

    /**
     * DbColumnInfo constructor.
     *
     * @param array $meta
     */
    public function __construct(array $meta)
    {
        $this->setName($meta['Field']);
        $this->setPrimary(strtolower($meta['Key']) == 'pri');
        $this->setIdentity(strtolower($meta['Extra']) == 'auto_increment');
        $this->setAllowNull(strtolower($meta['Null']) != 'no');
        $this->setUnsigned(strpos($meta['Type'], 'unsigned') !== false);
        $this->setDefault($meta['Default']);
        $this->setMultiLine(strpos($meta['Type'], 'text') !== false);

        $type = strtolower($meta['Type']);

        if (preg_match("#int#", $type)) {
            $this->setType('int');
        } elseif (preg_match("#(float|double|decimal)#", $type, $matches)) {
            $this->setType($matches[1]);
        } else {
            $this->setType('string');
        }

        if (in_array($this->getName(), ['enable', 'active'])
            or strpos($this->getName(), 'is_') === 0
        ) {
            $this->setType('boolean');
        }


    }

    /**
     * @return mixed
     */
    public function getDefault()
    {
        return $this->_default;
    }

    /**
     * @param mixed $default
     */
    public function setDefault($default)
    {
        $this->_default = (string)$default;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = strtolower($name);
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $type = strtolower($type);

        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @param string $length
     */
    public function setLength($length)
    {
        $this->length = $length;
    }

    /**
     * @return bool
     */
    public function isPrimary()
    {
        return $this->primary;
    }

    /**
     * @param bool $primary
     */
    public function setPrimary($primary)
    {
        $this->primary = $primary;
    }

    /**
     * @return bool
     */
    public function isIdentity()
    {
        return $this->identity;
    }

    /**
     * @param bool $identity
     */
    public function setIdentity($identity)
    {
        $this->identity = $identity;
    }

    /**
     * @return bool
     */
    public function isUnsigned()
    {
        return $this->unsigned;
    }

    /**
     * @param bool $unsigned
     */
    public function setUnsigned($unsigned)
    {
        $this->unsigned = $unsigned;
    }

    /**
     * @return bool
     */
    public function isRequired()
    {
        return !$this->allowNull;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return ucwords(implode(' ', explode('_', $this->name)));
    }

    /**
     * @return bool
     */
    public function isMultiLine()
    {
        return $this->multi_line;
    }

    /**
     * @param bool $multi_line
     */
    public function setMultiLine($multi_line)
    {
        $this->multi_line = $multi_line;
    }

    /**
     * @return bool
     */
    public function isString()
    {
        return $this->getType() == 'string';
    }

    /**
     * @return bool
     */
    public function isInt()
    {
        return $this->getType() == 'int';
    }

    /**
     * @return bool
     */
    public function isFloat()
    {
        return $this->getType() == 'float';
    }

    /**
     * @return bool
     */
    public function isDouble()
    {
        return $this->getType() == 'double';
    }

    /**
     * @return bool
     */
    public function isDecimal()
    {
        return $this->getType() == 'decimal';
    }

    /**
     * @return bool
     */
    public function isBoolean()
    {
        return $this->getType() == 'boolean';
    }

    /**
     * @return bool
     */
    public function isNumber()
    {
        return in_array($this->getType(), [
            'int',
            'double',
            'decimal',
            'float',
        ]);
    }
}