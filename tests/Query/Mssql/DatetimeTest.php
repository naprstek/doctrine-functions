<?php

namespace DoctrineFunctions\Tests\Query\Mssql;

class DatetimeTest extends \DoctrineFunctions\Tests\Query\MssqlTestCase
{

    public function testGetDate()
    {
        $dql = "SELECT p FROM DoctrineFunctions\Tests\Entities\Blank p WHERE getdate() = '2017-11-12'";
        $q = $this->entityManager->createQuery($dql);

        $sql = "SELECT b0_.id AS id_0 FROM Blank b0_ WHERE GetDate() = '2017-11-12'";

        $this->assertEquals($sql, $q->getSql());
    }

    public function testMonth()
    {
        $dql = "SELECT month(p.id) d FROM DoctrineFunctions\Tests\Entities\Blank p WHERE p.id = 1";
        $q = $this->entityManager->createQuery($dql);

        $sql = "SELECT MONTH(b0_.id) AS sclr_0 FROM Blank b0_ WHERE b0_.id = 1";

        $this->assertEquals($sql, $q->getSql());
    }

    public function testDatePart()
    {
        $dql = "SELECT datepart('weekday', p.id) d FROM DoctrineFunctions\Tests\Entities\Blank p WHERE p.id = 1";
        $q = $this->entityManager->createQuery($dql);

        $sql = "SELECT DATEPART(weekday, b0_.id) AS sclr_0 FROM Blank b0_ WHERE b0_.id = 1";

        $this->assertEquals($sql, $q->getSql(), 'DATEPART failed');
    }
}
