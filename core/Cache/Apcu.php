<?php

namespace Core\Cache;

use Core\Traits\Instance;
use Psr\SimpleCache\CacheInterface;

/**
 * @var APCu
 */
class Apcu implements CacheInterface
{
    use Instance;

    /**
     * ВРЕМЯ ЖИЗНИ КЕША => 24ч
     *
     *
     * @var int
     */
    protected int $ttl = 60 * 60 * 24;

    public function __construct(?int $ttl)
    {
        $this->ttl = $ttl ?? $this->ttl;
    }

    /**
     * Забрать из кеша
     *
     * @inheritDoc
     */
    public function get(string $key, mixed $default = null): mixed
    {
       return apcu_fetch($key) ?? $default;
    }

    /**
     * Установить
     *
     * @inheritDoc
     */
    public function set(string $key, mixed $value, \DateInterval|int|null $ttl = null): bool
    {
        apcu_store($key, $value, $ttl ?? $this->ttl);
        return true;
    }

    /**
     * @inheritDoc
     */
    public function delete(string $key): bool
    {
        apcu_delete($key);
        return  true;
    }

    /**
     * @inheritDoc
     */
    public function clear(): bool
    {
        return apc_clear_cache();
    }

    /**
     * @inheritDoc
     */
    public function getMultiple(iterable $keys, mixed $default = null): iterable
    {
        /** @var iterable $result */
        $result = [];
        foreach ($keys as $key){
            $result[$key] = $this->get($key, $default);
        }
        return $result;
    }

    /**
     * @inheritDoc
     */
    public function setMultiple(iterable $values, \DateInterval|int|null $ttl = null): bool
    {
        foreach ($values as $key => $value){
            $this->set($key, $value, $ttl);
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteMultiple(iterable $keys): bool
    {
        foreach ($keys as $key){
            $this->delete($key);
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function has(string $key): bool
    {
       return apcu_exists($key);
    }
}
