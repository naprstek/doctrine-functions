<?php

namespace DoctrineFunctions\Tests\Query\Mssql;

class StringTest extends \DoctrineFunctions\Tests\Query\MssqlTestCase
{

    public function testFormat()
    {
        $dql = "SELECT p FROM DoctrineFunctions\Tests\Entities\Blank p WHERE FORMAT(p.id, '000#') = '0001'";
        $q = $this->entityManager->createQuery($dql);

        $sql = "SELECT b0_.id AS id_0 FROM Blank b0_ WHERE FORMAT(b0_.id, '000#') = '0001'";

        $this->assertEquals($sql, $q->getSql());
    }

    public function testIsNull()
    {
        $dql = "SELECT isnull(p.id, '1') FROM DoctrineFunctions\Tests\Entities\Blank p WHERE p.id = 1";
        $q = $this->entityManager->createQuery($dql);

        $sql = "SELECT IsNull(b0_.id, '1') AS sclr_0 FROM Blank b0_ WHERE b0_.id = 1";

        $this->assertEquals($sql, $q->getSql());
    }

    public function testCast()
    {
        $dql = "SELECT CAST(p.id, 'int') FROM DoctrineFunctions\Tests\Entities\Blank p";
        $q = $this->entityManager->createQuery($dql);

        $sql = "SELECT CAST(b0_.id as int) AS sclr_0 FROM Blank b0_";

        $this->assertEquals($sql, $q->getSql());
    }
}
