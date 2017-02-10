<?php

namespace Phpfox\Payments;


class AddressBookTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $obj = new AddressBook();

        $this->assertNull($obj->getName());
    }

    public function testInitialize()
    {
        $obj = new AddressBook([
            'name'       => 'Example Name',
            'first_name' => '[Example First Name]',
            'last_name'  => '[Example Last Name]',
            'postcode'   => '[Example PostCode]',
            'phone'      => '[Example Phone Number]',
            'fax'        => '[Example Fax]',
            'city'       => '[Example City]',
            'country'    => '[Example Country]',
            'address1'   => '[Example Address 1]',
            'address2'   => '[Example Address 2]',
            'state'      => '[Example State]',
            'company'    => '[Example Company]',
            'title'      => '[Mr.]',
        ]);

        $this->assertSame('Example Name', $obj->getName());
        $this->assertSame('[Example First Name]', $obj->getFirstName());
        $this->assertSame('[Example Last Name]', $obj->getLastName());
        $this->assertSame('[Example Phone Number]', $obj->getPhone());
        $this->assertSame('[Example Fax]', $obj->getFax());
        $this->assertSame('[Example Address 1]', $obj->getAddress1());
        $this->assertSame('[Example Address 2]', $obj->getAddress2());
        $this->assertSame('[Example City]', $obj->getCity());
        $this->assertSame('[Example Company]', $obj->getCompany());
        $this->assertSame('[Example Country]', $obj->getCountry());
        $this->assertSame('[Example State]', $obj->getState());
        $this->assertSame('[Mr.]', $obj->getTitle());
        $this->assertSame('[Example PostCode]', $obj->getPostcode());
    }

    public function testSetter()
    {
        $obj = new AddressBook([
            'name'       => 'Example Name',
            'first_name' => '[Example First Name]',
            'last_name'  => '[Example Last Name]',
            'postcode'   => '[Example PostCode]',
            'phone'      => '[Example Phone Number]',
            'fax'        => '[Example Fax]',
            'city'       => '[Example City]',
            'country'    => '[Example Country]',
            'address1'   => '[Example Address 1]',
            'address2'   => '[Example Address 2]',
            'state'      => '[Example State]',
            'company'    => '[Example Company]',
            'title'      => '[Mr.]',
        ]);

        $obj->setName('Example Name');
        $obj->setFirstName('[Example First Name]');
        $obj->setLastName('[Example Last Name]');
        $obj->setPostcode('[Example PostCode]');
        $obj->setPhone('[Example Phone Number]');
        $obj->setFax('[Example Fax]');
        $obj->setCity('[Example City]');
        $obj->setCountry('[Example Country]');
        $obj->setAddress1('[Example Address 1]');
        $obj->setAddress2('[Example Address 2]');
        $obj->setState('[Example State]');
        $obj->setCompany('[Example Company]');
        $obj->setTitle('[Mr.]');

        $this->assertSame('Example Name', $obj->getName());
        $this->assertSame('[Example First Name]', $obj->getFirstName());
        $this->assertSame('[Example Last Name]', $obj->getLastName());
        $this->assertSame('[Example Phone Number]', $obj->getPhone());
        $this->assertSame('[Example Fax]', $obj->getFax());
        $this->assertSame('[Example Address 1]', $obj->getAddress1());
        $this->assertSame('[Example Address 2]', $obj->getAddress2());
        $this->assertSame('[Example City]', $obj->getCity());
        $this->assertSame('[Example Company]', $obj->getCompany());
        $this->assertSame('[Example Country]', $obj->getCountry());
        $this->assertSame('[Example State]', $obj->getState());
        $this->assertSame('[Mr.]', $obj->getTitle());
        $this->assertSame('[Example PostCode]', $obj->getPostcode());
    }
}
