<?php

declare(strict_types=1);

namespace PHPStanOriginalExtension;

use PhpParser\Node;
use PhpParser\Node\Expr;
use PhpParser\Node\Expr\FuncCall;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleError;

/**
 * @implements Rule<FuncCall>
 */
class LeftDebugScriptRule implements Rule
{
    /**
     * @inheritDoc
     */
    public function getNodeType(): string
    {
        return FuncCall::class;
    }

    /**
     * @param MethodCall $node
     * @param Scope $scope
     * @return array<string|RuleError>
     */
    public function processNode(Node $node, Scope $scope): array
    {
        if (!$node instanceof FuncCall) {
            return [];
        }
        if ($node->name instanceof Expr || strtolower((string)$node->name) !== 'var_dump') {
            return [];
        }

        return ["var_dump: argument type => {$scope->getType($node->args[0]->value)->describe(\PHPStan\Type\VerbosityLevel::value())}"];
    }
}
