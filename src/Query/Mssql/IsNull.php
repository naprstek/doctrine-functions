<?php

/**
 * Class Month
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

class IsNull extends FunctionNode
{
    private $check;
    private $replacement;

    public function getSql(SqlWalker $sqlWalker)
    {
        return sprintf('IsNull(%s, %s)', $this->check->dispatch($sqlWalker), $this->replacement->dispatch($sqlWalker));
    }

    public function parse(Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $this->check = $parser->ArithmeticPrimary();
        $parser->match(Lexer::T_COMMA);
        $this->replacement = $parser->ArithmeticPrimary();
        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }

}
