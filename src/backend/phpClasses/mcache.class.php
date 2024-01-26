<?php

class MCache
{
    private $memcached;

    public function __construct()
    {
        $this->memcached = new Memcached();
        $this->memcached->addServer('localhost', 11211);
    }

    public function set($key, $value, $expiration = 0)
    {
        return $this->memcached->set($key, $value, $expiration);
    }

    public function get($key)
    {
        return $this->memcached->get($key);
    }

    public function delete($key)
    {
        return $this->memcached->delete($key);
    }

    public function flush()
    {
        return $this->memcached->flush();
    }

    public function quit()
    {
        return $this->memcached->quit();
    }
}
