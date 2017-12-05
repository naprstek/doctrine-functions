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
}
