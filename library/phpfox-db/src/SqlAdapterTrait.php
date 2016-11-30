<?php
namespace Phpfox\Db;


Trait SqlAdapterTrait
{
    /**
     * @param string $table
     * @param array  $data
     *
     * @return SqlInsert
     */
    public function sqlInsert($table, $data)
    {
        return (new SqlInsert($this))->insert($table, $data);
    }

    /**
     * @param string $argv
     *
     * @return SqlSelect
     */
    public function select($argv = '*')
    {
        return (new SqlSelect($this))->select($argv);
    }

    /**
     * @param string $table
     * @param array  $data
     *
     * @return SqlUpdate
     */
    public function sqlUpdate($table, $data)
    {
        return (new SqlUpdate($this))->update($table)->values($data);
    }

    /**
     * @param string $table
     *
     * @return SqlDelete
     */
    public function sqlDelete($table)
    {
        return (new SqlDelete($this))->from($table);
    }
}