<?php

namespace DoctrineFunctions\Tests\Config;

/**
 * Test that checks the README describes all of the query types
 *
 * @author Steve Lacey <steve@stevelacey.net>
 */
class MssqlConfigTest extends \PHPUnit\Framework\TestCase
{

    /** @var array */
    protected $functions;

    public function setUp()
    {
        $yaml = new \Symfony\Component\Yaml\Parser();

        $config = $yaml->parse(file_get_contents(__DIR__ . '/../../config/mssql.yml'));
        $this->functions = array_merge(
            $config['doctrine']['orm']['dql']['string_functions']
        );
    }

    public function testFunctions()
    {
        $documented = $this->functions;

        $available = array_map(
            function ($path) {
            return 'DoctrineFunctions\\Query\\Mssql\\' . str_replace('.php', '', basename($path));
        }, glob(__DIR__ . '/../../src/Query/Mssql/*')
        );

        $undocumented = array_diff($available, $documented);

        if ($undocumented) {
            $this->fail(
                "The following MSSQL query functions are undocumented in mssql.yml\n\n" .
                implode("\n", $undocumented)
            );
        } else {
            $this->assertTrue(true, 'There are no undocumented functions.\n\n');
        }
    }

    public function testReadme()
    {
        preg_match('#\| MSSQL \| `(.*)` \|#', file_get_contents(__DIR__ . '/../../README.md'), $matches);

        $docs = explode(', ', strtolower($matches[1]));
        $keys = array_keys($this->functions);

        sort($docs);
        sort($keys);

        $this->assertEquals($docs, $keys);
    }
}
