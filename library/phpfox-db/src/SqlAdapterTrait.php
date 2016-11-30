<?php
namespace Phpfox\Db;


Trait SqlAdapterTrait
{
    /**
     * @param string     $table
     * @param array|null $data
     *
     * @return SqlInsert
     */
    public function insert($table, $data = null)
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
     * @param string     $table
     * @param array|null $data
     * @param array|null $where
     *
     * @return SqlUpdate
     */
    public function update($table, $data = null, $where = null)
    {
        $sql = (new SqlUpdate($this))->update($table);

        if (!empty($data)) {
            $sql->values($data);
        }

        if (!empty($where)) {
            $sql->where($where);
        }

        return $sql;
    }

    /**
     * @param string     $table
     * @param null|array $where
     *
     * @return SqlDelete
     */
    public function delete($table, $where = null)
    {
        $sql = (new SqlDelete($this))->from($table);

        if (!empty($where)) {
            $sql->where($where);
        }

        return $sql;
    }
}