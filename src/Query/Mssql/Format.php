<?php
/**
 * Class Format
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
    Doctrine\ORM\Query\SqlWalker;

class Format extends FunctionNode
{

    public $value = null;
    public $format = null;

    public function parse(\Doctrine\ORM\Query\Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $this->value = $parser->ArithmeticExpression();
        $parser->match(Lexer::T_COMMA);
        $this->format = $parser->StringPrimary();
        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }

    public function getSql(SqlWalker $sqlWalker)
    {
        return sprintf('FORMAT(%s, %s)', $this->value->dispatch($sqlWalker), $this->format->dispatch($sqlWalker));
    }
}
