<?php

namespace PHPSA\Analyzer\Pass\Statement;

use PhpParser\Node\Stmt;
use PHPSA\Analyzer\Helper\ConfigurablePassTrait;
use PHPSA\Analyzer\Pass;
use PHPSA\Context;

class DoNotUseGoto implements Pass\ConfigurablePassInterface, Pass\AnalyzerPassInterface
{
    use ConfigurablePassTrait;

    /**
     * @param Stmt\Goto_ $stmt
     * @param Context $context
     * @return bool
     */
    public function pass(Stmt\Goto_ $stmt, Context $context)
    {
        $context->notice('do_not_use_goto', 'Do not use goto statements', $stmt);

        return true;
    }

    /**
     * @return array
     */
    public function getRegister()
    {
        return [
            Stmt\Goto_::class,
        ];
    }
}
