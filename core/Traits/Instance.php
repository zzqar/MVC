<?php

namespace Core\Traits;

trait Instance
{
    private static array $instances;

    /**
     * Returns the application singleton or null if the singleton has not been created yet.
     *
     * @param mixed ...$args
     * @return $this
     */
    public static function getInstance(...$args): static
    {
        $className = static::class;

        if (!isset(self::$instances[$className])) {
            self::$instances[$className] = new $className(...$args);
        }

        return self::$instances[$className];
    }
}
