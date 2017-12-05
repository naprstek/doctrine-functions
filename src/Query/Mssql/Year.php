<?php

/**
 * Class MonthFunction
 *
 * Funkce MONTH() pro použití v DQL
 *
 * @category   Doctrine
 * @package    Query
 * @subpackage Functions
 * @copyright  Copyright (c) 2008-2013 RWE Interní služby, s.r.o
 * @license    http://framework.zend.com/license   BSD License
 * @version    Release: @package_version@
 */

namespace DoctrineFunctions\Query\Mssql;

use Doctrine\ORM\Query\AST\Functions\FunctionNode,
    Doctrine\ORM\Query\Lexer,
    Doctrine\ORM\Query\SqlWalker,
    Doctrine\ORM\Query\Parser;

class Year extends FunctionNode
{
    private $arg;

    public function getSql(SqlWalker $sqlWalker)
    {
        return sprintf('YEAR(%s)', $this->arg->dispatch($sqlWalker));
    }

    public function parse(Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $this->arg = $parser->ArithmeticPrimary();
        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }

}
