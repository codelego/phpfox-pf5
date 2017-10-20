<?php

namespace Neutron\Dev;


class TableInfo
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var ColumnInfo[]
     */
    protected $columns = [];

    /**
     * @var bool
     */
    protected $hasIdentity = false;

    /**
     * @var array
     */
    protected $primary = [];

    /**
     * DbTableInfo constructor.
     *
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
        $this->describe();
    }

    /**
     * @return ColumnInfo[]
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * @param string $name
     *
     * @return ColumnInfo|null
     */
    public function getColumn($name)
    {
        return isset($this->columns[$name]) ? $this->columns[$name] : null;
    }

    protected function describe()
    {
        $sql = _sprintf('describe {0}{1}', [PHPFOX_TABLE_PREFIX, $this->name]);
        $fields = _get('db')->execute($sql)->all();

        foreach ($fields as $field) {
            $columnInfo = new ColumnInfo($field);
            $this->columns[$columnInfo->getName()] = $columnInfo;

            if ($columnInfo->isIdentity()) {
                $this->hasIdentity = true;
            }

            if ($columnInfo->isPrimary()) {
                $this->primary[] = $columnInfo->getName();
            }
        }
    }

    /**
     * @return bool
     */
    public function isHasIdentity()
    {
        return $this->hasIdentity;
    }

    /**
     * @return array
     */
    public function getPrimary()
    {
        return $this->primary;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}