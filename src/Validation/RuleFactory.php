<?php
namespace KennedyTedesco\Validation;

use ReflectionClass;

final class RuleFactory
{
    /**
     * @const string
     */
    const RULE_PATH = 'Respect\\Validation\\Rules\\';

    /**
     * @var array Rules alias for compatibility (avoiding conflict with Laravel)
     */
    private static $alias = [
        'FileExists' => 'Exists'
    ];

    public static function make($rule, array $parameters = [])
    {
        $class = self::RULE_PATH . self::getRule($rule);
        $validator = new ReflectionClass($class);
        return $validator->newInstanceArgs($parameters);
    }

    private static function getRule($rule)
    {
        return isset(self::$alias[$rule]) ? self::$alias[$rule] : $rule;
    }
}