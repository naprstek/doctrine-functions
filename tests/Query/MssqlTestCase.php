<?php

namespace DoctrineFunctions\Tests\Query;

class MssqlTestCase extends DbTestCase
{

    public function setUp()
    {
        parent::setUp();
        ConfigLoader::load($this->configuration, 'mssql');
    }
}
