<?php

namespace DoctrineFunctions\Tests\Query;

use Doctrine\ORM\Configuration;
use Symfony\Component\Yaml\Parser;

class ConfigLoader
{

    /**
     * @param Configuration $configuration
     * @param string        $database
     */
    public static function load(Configuration $configuration, $database)
    {
        $parser = new Parser();
        // Load the corresponding config file.
        $config = $parser->parse(file_get_contents(realpath(__DIR__ . '/../../config/' . $database . '.yml')));
        $parsed = $config['doctrine']['orm']['dql'];

        if (array_key_exists('string_functions', $parsed)) {
            foreach ($parsed['string_functions'] as $key => $value) {
                $configuration->addCustomStringFunction(strtoupper($key), $value);
            }
        }
    }
}
