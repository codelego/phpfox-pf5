<?php

namespace Phpfox\RapidDev;


class ColumnInfoTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return ColumnInfo
     */
    public function testBase()
    {
        $meta = [
            'Field'   => 'locale_id',
            'Type'    => 'varchar(16)',
            'Null'    => 'NO',
            'Key'     => 'PRI',
            'Default' => '',
            'Extra'   => '',
        ];

        $column = new ColumnInfo($meta);

        $this->assertSame('locale_id', $column->getName());
        $this->assertSame('Locale Id', $column->getLabel());
        $this->assertSame(true, $column->isPrimary());
        $this->assertSame(false, $column->isIdentity());
        $this->assertSame(false, $column->isAllowNull());
        $this->assertSame(true, $column->isRequired());
        $this->assertSame(false, $column->isUnsigned());
        $this->assertSame('', $column->getDefault());
        $this->assertSame(false, $column->isMultiLine());

        return $column;
    }
}
