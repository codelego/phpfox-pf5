<?php

namespace Phpfox\Db;


class DbTableGatewayFactory
{
    /**
     * @param string $id
     * @param string $table
     * @param string $prototype
     * @param string $meta
     * @param string $adapter
     * @param string $gateway
     *
     * @return DbTableGateway
     */
    public function factory(
        $id,
        $table,
        $prototype,
        $meta,
        $adapter = null,
        $gateway = null
    ) {
        if (!$gateway) {
            $gateway = DbTableGateway::class;
        }

        if (PHPFOX_ENV == 'development' and $meta != null) {
            if (!file_exists($filename = PHPFOX_APP_DIR . $meta)) {
                $this->exportModel($filename, preg_replace('/\s+/', '',
                    var_export($this->describe($table), true)));
            }
        }

        return new $gateway($id, $table, $prototype, $adapter, $meta);
    }

    public function exportModel($file, $data)
    {
        if (file_exists($file)) {
            @unlink($file);
        }

        if (!is_dir($dir = dirname($file)) && !@mkdir($dir, 0777, true)) {
            exit('Can not open ' . $dir . ' to write export');
        }

        if (!is_string($data)) {
            $data = var_export($data, true);
        }

        file_put_contents($file,
            '<?php return ' . $data . ';');

        if (file_exists($file)) {
            @chmod($file, 0777);
        }
    }

    /**
     * This method work only with mysqli extension, please ensure you does not
     * use describe on production mode.
     *
     * @param string $table
     *
     * @return array
     */
    public function describe($table)
    {
        if (substr($table, 0, 1) == ':') {
            $table = PHPFOX_TABLE_PREFIX . substr($table, 1);
        }

        $rows = \Phpfox::get('db')
            ->execute('describe ' . $table)
            ->all();


        $column = [];
        $primary = [];
        $identity = null;
        $queryId = null;

        foreach ($rows as $row) {
            $column[$row['Field']] = 1;

            if (strtolower($row['Key']) == 'pri') {
                $primary[$row['Field']] = 1;
            }

            if (strtolower($row['Extra']) == 'auto_increment') {
                $identity = $row['Field'];
            }
        }

        if ($identity) {
            $queryId = $identity;
        } elseif (count($primary) == 1) {
            $queryId = array_keys($primary)[0];
        }

        return [$identity, $primary, $queryId, $column, []];
    }
}