<?php

namespace Tests\PHPSA\Expression\Operators\Comparison;

use PhpParser\Node;
use PHPSA\CompiledExpression;
use PHPSA\Visitor\Expression;

abstract class BaseTestCase extends \Tests\PHPSA\TestCase
{
    /**
     * @return array
     */
    public function smallerDataProvider()
    {
        return array(
            array(-1, -1),
            array(-2, -1),
            array(-3, -1),
            array(-50, -1),
            array(1, 2),
            array(1, 5),
            array(6, 5),
        );
    }

    /**
     * @param $a
     * @param $b
     * @return mixed
     */
    abstract protected function operator($a, $b);

    /**
     * Tests {int} $operator {int} = {int}
     *
     * @dataProvider smallerDataProvider
     */
    public function testSmaller($a, $b)
    {
        $baseExpression = new Node\Expr\BinaryOp\Smaller(
            $this->newScalarExpr($a),
            $this->newScalarExpr($b)
        );
        $compiledExpression = $this->compileExpression($baseExpression);

        $this->assertInstanceOfCompiledExpression($compiledExpression);
        $this->assertSame(CompiledExpression::BOOLEAN, $compiledExpression->getType());
        $this->assertSame($this->operator($a, $b), $compiledExpression->getValue());
    }
}
