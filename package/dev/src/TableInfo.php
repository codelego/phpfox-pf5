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

    protected function describe()
    {
        $sql = _sprintf('describe {0}{1}', [PHPFOX_TABLE_PREFIX, $this->name]);
        $fields = _service('db')->execute($sql)->all();

        foreach ($fields as $field) {
            $columnInfo = new ColumnInfo($field);
            $this->columns[$columnInfo->getName()] = $columnInfo;
        }
    }
}