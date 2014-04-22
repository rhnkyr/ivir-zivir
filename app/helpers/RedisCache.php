<?php
class RedisCache
{
    const KEY_PREFIX = 'cache:';
    protected $_client;

    public function __construct(\Predis\Client $client)
    {
        $this->_client = $client;
    }

    public function load($key)
    {
        $redis = $this->_client;
        $formattedKey = self::KEY_PREFIX.$key;

        if (!$redis->exists($formattedKey))
            return false;

        $serializedValue = $redis->get($formattedKey);

        return empty($serializedValue) ?
            false : unserialize($serializedValue);
    }

    public function save($key, $value, $ttl = 3600)
    {
        $redis = $this->_client;
        $formattedKey = self::KEY_PREFIX.$key;

        $serializedValue = serialize($value);

        return $redis->set($formattedKey, $serializedValue)
        and $redis->expire($formattedKey, $ttl);
    }
}