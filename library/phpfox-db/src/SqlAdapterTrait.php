<?php
namespace Phpfox\Db;


Trait SqlAdapterTrait
{
    public function sqlInsert($table, $data)
    {
        return (new SqlInsert($this))->insert($table, $data);
    }

    public function sqlSelect()
    {
        return new SqlSelect($this);
    }

    public function sqlUpdate($table, $data)
    {
        return (new SqlUpdate($this))->update($table)->values($data);
    }

    public function sqlDelete($table)
    {
        return (new SqlDelete($this))->from($table);
    }
}