<?php
/**
 * Main Rediscluster class
 *
 * @category RedisCluster
 * @package  RedisCluster
 * @author   (c) Salimane Adjao Moustapha <me@salimane.com>
 * @license  MIT http://www.opensource.org/licenses/mit-license.php
 * @version  0.5.3
 * @link     https://github.com/salimane/rediscluster-php
 */

namespace RedisCluster;

/**
 * Implementation of the RedisCluster Client using phpredis extension Redis class
 * This abstract class provides a php interface to all Redis
 * and implementing how the commands are sent to and received from the cluster.
 *
 * @category RedisCluster
 * @package  RedisCluster
 * @author   (c) Salimane Adjao Moustapha <me@salimane.com>
 * @license  MIT http://www.opensource.org/licenses/mit-license.php
 * @link     https://github.com/salimane/rediscluster-php
 */
class RedisCluster
{
    /**
     * servers array used during construct
     * @var array
     * @access public
     */
    public $cluster;

    /**
     * number of servers array used during construct
     * @var array
     * @access public
     */
    public $no_servers;

    /**
     * Collection of Redis objects attached to Redis servers
     * @var array
     * @access private
     */
    private $_redises;

    /**
     * instance of the Redis class from php extension
     * @var resource
     * @access private
     */
    private $_redis;

    /**
     * The read commands
     * @var array
     * @access private
     */
    private static $_read_keys = array(
            'debug' => 'debug', 'getbit' => 'getbit',
            'get' => 'get', 'getrange' => 'getrange', 'hget' => 'hget',
            'hgetall' => 'hgetall', 'hkeys' => 'hkeys', 'hlen' => 'hlen',
            'hmget' => 'hmget',
            'hvals' => 'hvals', 'lindex' => 'lindex', 'llen' => 'llen',
            'lrange' => 'lrange', 'object' => 'object',
            'scard' => 'scard', 'sismember' => 'sismember', 'smembers' => 'smembers',
            'srandmember' => 'srandmember', 'strlen' => 'strlen', 'type' => 'type',
            'zcard' => 'zcard', 'zcount' => 'zcount', 'zrange' => 'zrange',
            'zrangebyscore' => 'zrangebyscore',
            'zrank' => 'zrank', 'zrevrange' => 'zrevrange',
            'zrevrangebyscore' => 'zrevrangebyscore',
            'zrevrank' => 'zrevrank', 'zscore' => 'zscore',
            'mget' => 'mget', 'bitcount' => 'bitcount', 'echo' => 'echo',
            'substr' => 'substr', 'keys' => 'keys', 'randomkey' => 'randomkey',
            'dbsize' => 'dbsize',
            'getMultiple' => 'getMultiple', 'dbSize' => 'dbSize', 'randomKey' => 'randomKey',
            'lSize' => 'lSize', 'lsize' => 'lsize', 'lGetRange' => 'lGetRange',
            'sContains' => 'sContains', 'sSize' => 'sSize',
            'sGetMembers' => 'sGetMembers',
            'zSize' => 'zSize', 'getkeys' => 'getkeys',
    );

    /**
     * The write commands
     * @var array
     * @access private
    */
    private static $_write_keys = array(
            'append' => 'append', 'blpop' => 'blpop', 'brpop' => 'brpop',
            'brpoplpush' => 'brpoplpush',
            'decr' => 'decr', 'decrby' => 'decrby', 'del' => 'del',
            'exists' => 'exists', 'hexists' => 'hexists',
            'expire' => 'expire', 'expireat' => 'expireat', 'pexpire' => 'pexpire',
            'pexpireat' => 'pexpireat', 'getset' => 'getset', 'hdel' => 'hdel',
            'hincrby' => 'hincrby', 'hincrbyfloat' => 'hincrbyfloat', 'hset' => 'hset',
            'hsetnx' => 'hsetnx', 'hmset' => 'hmset',
            'incr' => 'incr', 'incrby' => 'incrby', 'incrbyfloat' => 'incrbyfloat',
            'linsert' => 'linsert', 'lpop' => 'lpop',
            'lpush' => 'lpush', 'lpushx' => 'lpushx', 'lrem' => 'lrem', 'lset' => 'lset',
            'ltrim' => 'ltrim', 'move' => 'move',
            'persist' => 'persist', 'publish' => 'publish', 'psubscribe' => 'psubscribe',
            'punsubscribe' => 'punsubscribe',
            'rpop' => 'rpop', 'rpoplpush' => 'rpoplpush', 'rpush' => 'rpush',
            'rpushx' => 'rpushx', 'sadd' => 'sadd', 'sdiff' => 'sdiff',
            'sdiffstore' => 'sdiffstore',
            'set' => 'set', 'setbit' => 'setbit', 'setex' => 'setex', 'setnx' => 'setnx',
            'setrange' => 'setrange', 'sinter' => 'sinter',
            'sinterstore' => 'sinterstore', 'smove' => 'smove',
            'sort' => 'sort', 'spop' => 'spop', 'srem' => 'srem',
            'subscribe' => 'subscribe',
            'sunion' => 'sunion', 'sunionstore' => 'sunionstore',
            'unsubscribe' => 'unsubscribe', 'unwatch' => 'unwatch',
            'watch' => 'watch', 'zadd' => 'zadd', 'zincrby' => 'zincrby',
            'zinterstore' => 'zinterstore',
            'zrem' => 'zrem', 'zremrangebyrank' => 'zremrangebyrank',
            'zremrangebyscore' => 'zremrangebyscore', 'zunionstore' => 'zunionstore',
            'mset' => 'mset','msetnx' => 'msetnx', 'rename' => 'rename',
            'renamenx' => 'renamenx', 'bitop' => 'bitop',
            'del' => 'del', 'ttl' => 'ttl', 'pttl' => 'pttl', 'flushall' => 'flushall',
            'flushdb' => 'flushdb', 'renameKey' => 'renameKey',
            'listTrim' => 'listTrim', 'lRemove' => 'lRemove', 'sRemove' => 'sRemove',
            'setTimeout' => 'setTimeout', 'zDelete' => 'zDelete',
            'zDeleteRangeByScore' => 'zDeleteRangeByScore', 'zDeleteRangeByRank' => 'zDeleteRangeByRank',
            'delete' => 'delete'
                    );

    /**
     * The commands that are not subject to hashing
     * @var array
     * @access private
    */
    private static $_dont_hash = array(
            'auth' => 'auth', 'monitor' => 'monitor', 'quit' => 'quit',
            'shutdown' => 'shutdown', 'slaveof' => 'slaveof', 'slowlog' => 'slowlog', 'sync' => 'sync',
            'discard' => 'discard', 'exec' => 'exec', 'multi' => 'multi',
            'setOption' => 'setOption', 'getOption' => 'getOption'
    );

    /**
     * The commands that are needs the keys they are processing to be tagged
     * when hashing for the cluster
     * @var array
     * @access private
    */
    private static $_tag_keys = array(
            'mget' => 'mget', 'rename' => 'rename', 'renamenx' => 'renamenx',
            'mset' => 'mset', 'msetnx' => 'msetnx',
            'brpoplpush' => 'brpoplpush', 'rpoplpush' => 'rpoplpush',
            'sdiff' => 'sdiff', 'sdiffstore' => 'sdiffstore',
            'sinter' => 'sinter', 'sinterstore' => 'sinterstore',
            'sunion' => 'sunion', 'sunionstore' => 'sunionstore',
            'smove' => 'smove', 'zinterstore' => 'zinterstore',
            'zunionstore' => 'zunionstore', 'sort' => 'sort'
    );

    /**
     * The commands that could be sent to all the servers and
     * return the aggregrate results
     * @var array
     * @access private
    */
    private static $_loop_keys = array(
            'keys' => 'keys', 'getkeys' => 'getkeys',
            'dbsize' => 'dbsize', 'dbSize' => 'dbSize',

            'select' => 'select',
            'save' => 'save', 'bgsave' => 'bgsave',
            'bgrewriteaof' => 'bgrewriteaof',
            'info' => 'info',
            'lastsave' => 'lastsave', 'ping' => 'ping',
            'flushall' => 'flushall', 'flushdb' => 'flushdb',
            'sync' => 'sync',
            'config' => 'config', 'time' => 'time'
    );

    /**
     * The admin type commands that could be sent to all the servers and
     * return the aggregrate results
     * @var array
     * @access private
    */
    private static $_loop_keys_admin = array(
            'select' => 'select',
            'save' => 'save', 'bgsave' => 'bgsave',
            'bgrewriteaof' => 'bgrewriteaof',
            'info' => 'info',
            'lastsave' => 'lastsave', 'ping' => 'ping',
            'flushall' => 'flushall', 'flushdb' => 'flushdb',
            'sync' => 'sync',
            'config' => 'config', 'time' => 'time'
    );

    /**
     * Creates a Redis interface to a cluster of Redis servers
     *
     * @param array $cluster The Redis servers in the cluster.
     * @param int   $redisdb the db to be selected
     * @param boolean $masters_only if read commands should also be routed to master servers
    */
    public function __construct($cluster, $redisdb = 0, $masters_only = false)
    {
        //die when wrong server array
        if (empty($cluster['nodes'])) {
            error_log("RedisCluster: Please set a correct array of redis servers.", 0);
            die();
        }

        $this->cluster = $cluster;
        $have_master_of = isset($this->cluster['master_of']);
        $this->no_servers = $have_master_of ? count($this->cluster['master_of']) : count($this->cluster['nodes']);
        $redises_cons = array();

        //connect to all servers
        foreach ($this->cluster['nodes'] as $alias => $server) {

            if ($have_master_of && !isset($this->cluster['master_of'][$alias])) {
                continue;
            }

            if (isset($redises_cons[$server['host'] . ':' . $server['port']])) {
                $this->_redises[$alias] = $redises_cons[$server['host'] . ':' . $server['port']]['master'];
                $this->_redises[$alias . '_slave'] = $redises_cons[$server['host'] . ':' . $server['port']]['slave'];
                $this->cluster['slaves'][$alias . '_slave'] = $redises_cons[$server['host'] . ':' . $server['port']]['slave_node'];
            } else {
                try {
                    //connect to master
                    $this->_redis = self::_connect($server['host'], $server['port'], $redisdb);
                    if (!$masters_only && !$have_master_of) {
                        $info = $this->_redis->info();
                        if (empty($info['role'])) {
                            error_log("RedisCluster: server " . $server['host'] .':'. $server['port'] . " can't get info role.", 0);
                            die;
                        } elseif ($info['role'] != 'master') {
                            error_log("RedisCluster: server " . $server['host'] .':'. $server['port'] . " is not a master.", 0);
                            die;
                        }
                    }

                    $this->_redises[$alias] = $this->_redis;
                    $redises_cons[$server['host'] . ':' . $server['port']]['master'] =  $this->_redises[$alias];

                    //connect to slave
                    $slave_connected = false;
                    $slave = array();
                    if (!$masters_only) {
                        if ($have_master_of) {
                            $slave = $this->cluster['nodes'][$this->cluster['master_of'][$alias]];
                        } elseif (!empty($info['connected_slaves'])) {
                            @list($slave_host, $slave_port, $slave_online) = explode(',', $info['slave0']);
                            if ($slave_online == 'online') {
                                $slave = array('host' => $slave_host, 'port' => $slave_port);
                            }
                        }
                    }

                    if (!empty($slave)) {

                        try {
                            $redis_slave = self::_connect($slave['host'], $slave['port'], $redisdb);
                            $this->_redises[$alias . '_slave'] =  $redis_slave;
                            $this->cluster['slaves'][$alias . '_slave'] = array('host' => $slave['host'], 'port' => $slave['port']);
                            $redises_cons[$server['host'] . ':' . $server['port']]['slave'] =  $this->_redises[$alias . '_slave'];
                            $redises_cons[$server['host'] . ':' . $server['port']]['slave_node'] =  $this->cluster['slaves'][$alias . '_slave'];
                            $slave_connected = true;

                        } catch (\RedisException $e) {
                            error_log("RedisCluster cannot connect to: " . $slave['host'] .':'. $slave['port'] . " " . $e->getMessage(), 0);
                        }
                    }

                    if (!$slave_connected) {
                        $this->_redises[$alias . '_slave'] = $this->_redis;
                        $this->cluster['slaves'][$alias . '_slave'] = $server;
                        $redises_cons[$server['host'] . ':' . $server['port']]['slave'] =  $this->_redises[$alias . '_slave'];
                        $redises_cons[$server['host'] . ':' . $server['port']]['slave_node'] =  $this->cluster['slaves'][$alias . '_slave'];
                    }

                } catch (\RedisException $e) {
                    error_log("RedisCluster cannot connect to: " . $server['host'] .':'. $server['port'] . " " . $e->getMessage(), 0);
                    die;
                }
            }
        }
        unset($redises_cons);
    }

    /**
     * select a db on all the servers
     *
     * @param int $redisdb The redis db to be selected.
     *
     * @return void
     */
    private static function _connect($host, $port, $redisdb, $timeout = 0)
    {
        $redis = new \Redis();
        try {
            $redis->pconnect($host, $port, $timeout);
            $redis->select($redisdb);
        } catch (\RedisException $e) {
            $redis->pconnect($host, $port, $timeout);
            $redis->select($redisdb);
        }

        return $redis;
    }

    /**
     * select a db on all the servers
     *
     * @param int $redisdb The redis db to be selected.
     *
     * @return void
     */
    public function setSelectDB($redisdb = 0)
    {
        //select new db for to all servers
        foreach ($this->_redises as $alias => $server) {
            try {
                $server->select($redisdb);
            } catch (\RedisException $e) {
                $addr = isset($this->cluster['nodes'][$alias]) ? $this->cluster['nodes'][$alias]['host'] . ':' . $this->cluster['nodes'][$alias]['port'] : $this->cluster['slaves'][$alias . '_slave']['host'] . ':' . $this->cluster['slaves'][$alias . '_slave']['port'];
                error_log("RedisCluster setSelectDB : " . $e->getMessage(). " on " . $addr . "  db $redisdb", 0);
                die;
            }
            $this->_redises[$alias] =  $server;
        }
    }

    /**
     * Magic method to handle all function requests
     *
     * @param string $name The name of the method called.
     * @param array  $args Array of supplied arguments to the method.
     *
     * @return mixed Return value from Redis::__call() based on the command.
     */
    public function __call($name, $args)
    {
        
        $name = strtolower($name);
        if (!isset(self::$_loop_keys[$name])) {
            // take care of hash tags
            $tag_start = false;
            $key_array = false;
            $hash_tag = '';
            if (is_array($args[0])) {
                $key_array = true;
                $hash_tag = key($args[0]);
                if ($hash_tag !== NULL) {
                    if ($hash_tag === 0) {
                        $tag_start = strripos($args[0][0], '{');
                    } else {
                        $tag_start = strripos($hash_tag, '{');
                    }
                }
            } else {
                $tag_start = strripos($args[0], '{');
            }

            // trigger error msg on tag keys unless we have hash tags e.g. "bar{zap}"
            if (isset(self::$_tag_keys[$name]) && !$tag_start) {
                if (is_callable(array($this, "_rc_$name"))) {
                    $name = "_rc_$name";
                    $argcount = count($args);
                    if (1 == $argcount) {
                        return $this->$name($args[0]);
                    } elseif (2 == $argcount) {
                        return $this->$name($args[0], $args[1]);
                    } else {
                        return call_user_func_array(array($this, $name), $args);
                    }
                } else {
                    throw new \RedisException("RedisCluster: Command $name Not Supported (each key name has its own node)");
                }
            }
           
            // get the hash key
            $hkey = $args[0];
            //take care of hash tags names for forcing multiple keys on the same node,
            //e.g. $r->set("bar{zap}", "bar"), $r->mget(array("a{a}","b"))
            if ($tag_start) {
                if ($key_array) {
                    if ($hash_tag === 0) {
                        $hkey = substr($args[0][$hash_tag], $tag_start+1, -1);
                        $args[0][$hash_tag] = substr($args[0][$hash_tag], 0, $tag_start);
                    } else {
                        $hkey = substr($hash_tag, $tag_start+1, -1);
                        $args[0][substr($hash_tag, 0, $tag_start)] = $args[0][$hash_tag];
                        unset($args[0][$hash_tag]);
                    }
                } else {
                    $hkey = substr($args[0], $tag_start+1, -1);
                    $args[0] = substr($args[0], 0, $tag_start);
                }
            }

            //get the node number
            $node = $this->_getnodenamefor($hkey);
            if (isset(self::$_write_keys[$name])) {
                $redisent = $this->_redises[$node];
            } elseif (isset(self::$_read_keys[$name])) {
                $redisent = $this->_redises[$node . '_slave'];
            } else {
                throw new \RedisException("RedisCluster: Command $name Not Supported ");
            }
            //print_r($redisent);
            //print_r($args);
            // Execute the command on the server
            try {
                $argcount = count($args);
                if (1 == $argcount) {
                    return $redisent->$name($args[0]);
                } elseif (2 == $argcount) {
                    return $redisent->$name($args[0], $args[1]);
                } elseif (3 == $argcount) {
                    return $redisent->$name($args[0], $args[1], $args[2]);
                } else {
                    return call_user_func_array(array($redisent, $name), $args);
                }

            } catch (\RedisException $e) {
                $addr = isset($this->cluster['nodes'][$node]) ? $this->cluster['nodes'][$node]['host'] . ':' . $this->cluster['nodes'][$node]['port'] : $this->cluster['slaves'][$node . '_slave']['host'] . ':' . $this->cluster['slaves'][$node . '_slave']['port'];
                error_log("RedisCluster: " . $e->getMessage()." on $name on " . $addr, 0);

                return null;
            }
        } else {
           
            // take care of keys that don't need to go through master and slaves redis servers
            if (!isset(self::$_loop_keys_admin[$name])) {
                if (is_callable(array($this, "_rc_$name"))) {
                    $name = "_rc_$name";
                    $argcount = count($args);
                    if (1 == $argcount) {
                        return $this->$name($args[0]);
                    } elseif (2 == $argcount) {
                        return $this->$name($args[0], $args[1]);
                    } else {
                        return call_user_func_array(array($this, $name), $args);
                    }
                } else {
                    throw new \RedisException("RedisCluster: Command $name Not Supported (each key name has its own node)");
                }
            }
           
            $result = array();
            foreach ($this->_redises as $alias => $redisent) {
                try {
                    if ((isset(self::$_write_keys[$name]) && stripos($alias, '_slave') !== false) || (isset(self::$_read_keys[$name]) && stripos($alias, '_slave') === false)) {
                        $res = null;
                    } else {
                        $res = call_user_func_array(array($redisent, $name), $args);
                    }
                } catch (\RedisException $e) {
                    $addr = isset($this->cluster['nodes'][$alias]) ? $this->cluster['nodes'][$alias]['host'] . ':' . $this->cluster['nodes'][$alias]['port'] : $this->cluster['slaves'][$alias . '_slave']['host'] . ':' . $this->cluster['slaves'][$alias . '_slave']['port'];
                    error_log("RedisCluster __call function: " . $e->getMessage() . " on $name on " . $addr, 0);
                    $res = null;
                }
                $result[$alias] = $res;
            }

            return $result;
        }
    }

    /**
     * Return the node name where the ``name`` would land to
     *
     * @param string $name the key being hashed
     *
     * @return string
     */
    private function _getnodenamefor($name)
    {
        return 'node_' . ((abs(crc32($name)) % $this->no_servers) + 1);
    }

    /**
     * Return the node where the ``name`` would land to
     *
     * @param string $name the key being hashed
     *
     * @return array
     */
    public function getnodefor($name)
    {
        $node = $this->_getnodenamefor($name);

        return array($node => $this->cluster['nodes'][$node]);
    }

    /**
     * Return the encoding, idletime, or refcount about the key
     *
     * @param string $infotype the info being requested
     * @param string $key      the key supplied
     *
     * @return string
     */
    public function object($infotype, $key)
    {
        $redisent = $this->_redises[$this->_getnodenamefor($key) . '_slave'];

        return $redisent->object($infotype, $key);
    }

    /**
     * Pop a value off the tail of ``src``, push it on the head of ``dst``
     * and then return it.
     * This command blocks until a value is in ``src`` or until ``timeout``
     * seconds elapse, whichever is first. A ``timeout`` value of 0 blocks
     * forever.
     * Not atomic
     *
     * @param string $src     the source list
     * @param string $dst     the destination list
     * @param int    $timeout the timeout
     *
     * @return string | bool
     */
    private function _rc_brpoplpush($src, $dst, $timeout)
    {
        $rpop = $this->brpop($src, $timeout);
        if (!empty($rpop)) {
            $this->lpush($dst, $rpop[1]);

            return $rpop[1];
        }

        return false;
    }

    /**
     * RPOP a value off of the ``src`` list and LPUSH it
     * on to the ``dst`` list.  Returns the value.
     *
     * @param string $src the source list
     * @param string $dst the destination list
     *
     * @return string | bool
     */
    private function _rc_rpoplpush($src, $dst)
    {
        $rpop = $this->rpop($src);
        if ($rpop) {
            if ($this->lpush($dst, $rpop)) {
                return $rpop;
            }
        }

        return false;
    }

    /**
     * Returns the members of the set resulting from the difference between
     * the first set and all the successive sets.
     *
     * @return array
     */
    private function _rc_sdiff()
    {
        $args = func_get_args();
        $src = array_shift($args);
        $src_set = $this->smembers($src);
        if (!empty($src_set)) {
            foreach ($args as $key) {
                $res = $this->smembers($key);
                if (false === $res) {
                    return false;
                }
                if (!empty($res)) {
                    $src_set = array_diff($src_set, $res);
                }
            }

            return array_values($src_set);
        }

        return $src_set;
    }

    /**
     * Store the difference of sets ``src``,  ``args`` into a new
     * set named ``dest``.  Returns the number of keys in the new set.
     *
     * @return int
     */
    private function _rc_sdiffstore()
    {
        $args = func_get_args();
        $dst = array_shift($args);
        $result = call_user_func_array(array($this, 'sdiff'), $args);
        if (!empty($result)) {
            $res = 0;
            foreach ($result as $k => $v) {
                $res += (int) $this->sadd($dst, $v);
            }

            return $res;
        }

        return 0;
    }

    /**
     * Returns the members of the set resulting from the difference between
     * the first set and all the successive sets.
     *
     * @return array
     */
    private function _rc_sinter()
    {
        $args = func_get_args();
        $src = array_shift($args);
        $src_set = $this->smembers($src);
        if (!empty($src_set)) {
            foreach ($args as $key) {
                $res = $this->smembers($key);
                if (false === $res) {
                    return false;
                }
                if (!empty($res)) {
                    $src_set = array_intersect($src_set, $res);
                }
            }

            return array_values($src_set);
        }

        return $src_set;
    }

    /**
     * Store the difference of sets ``src``,  ``args`` into a new
     * set named ``dest``.  Returns the number of keys in the new set.
     *
     * @return int
     */
    private function _rc_sinterstore()
    {
        $args = func_get_args();
        $dst = array_shift($args);
        $result = call_user_func_array(array($this, 'sinter'), $args);
        if (!empty($result)) {
            $res = 0;
            foreach ($result as $k => $v) {
                $res += (int) $this->sadd($dst, $v);
            }

            return $res;
        }

        return 0;
    }

    /**
     * Move ``$value`` from set ``$src`` to set ``$dst``
     * not atomic
     *
     * @param string $src   the source set
     * @param string $dst   the destination set
     * @param string $value the value being moved
     *
     * @return bool
     */
    private function _rc_smove($src, $dst, $value)
    {
        if ($this->type($src) == \Redis::REDIS_SET && $this->type($dst) == \Redis::REDIS_SET  && $this->srem($src, $value)) {
            return (bool) $this->sadd($dst, $value);
        }

        return false;
    }

    /**
     * Returns the members of the set resulting from the union between
     * the first set and all the successive sets.
     *
     * @return array
     */
    private function _rc_sunion()
    {
        $args = func_get_args();
        $src = array_shift($args);
        $src_set = $this->smembers($src);
        if (!empty($src_set)) {
            foreach ($args as $key) {
                $res = $this->smembers($key);
                if (false === $res) {
                    return false;
                }
                if (!empty($res)) {
                    $src_set = array_unique(array_merge($src_set, $res));
                }
            }

            return array_values($src_set);
        }

        return $src_set;
    }

    /**
     * Store the union of sets ``src``,  ``args`` into a new
     * set named ``dest``.  Returns the number of keys in the new set.
     *
     * @return int
     */
    private function _rc_sunionstore()
    {
        $args = func_get_args();
        $dst = array_shift($args);
        $result = call_user_func_array(array($this, 'sunion'), $args);
        if (!empty($result)) {
            $res = 0;
            foreach ($result as $k => $v) {
                $res += (int) $this->sadd($dst, $v);
            }

            return $res;
        }

        return 0;
    }

    /**
     * Sets each key in the ``args`` dict to its corresponding value
     *
     * @return bool
     */
    private function _rc_mset()
    {
        $args = func_get_args();
        $args = array_shift($args);
        $result = true;
        foreach ($args as $k => $v) {
            $result = $result && $this->set($k, $v);
        }

        return $result;
    }

    /**
     * Sets each key in the ``args`` dict to its corresponding value if
     * none of the keys are already set
     *
     * @return bool
     */
    private function _rc_msetnx()
    {
        $args = func_get_args();
        $args = array_shift($args);
        foreach ($args as $k => $v) {
            if ($this->exists($k)) {
                return false;
            }
        }

        return $this->_rc_mset($args);
    }

    /**
     * Returns a list of values ordered identically to ``$args``
     *
     * @return array
     */
    private function _rc_mget()
    {
        $args = func_get_args();
        $args = array_shift($args);
        $result = array();
        foreach ($args as $key) {
            $result[] = $this->get($key);
        }

        return $result;
    }

    /**
     * Rename key ``$src`` to ``$dst``
     *
     * @param string $src the source set
     * @param string $dst the destination set
     *
     * @return bool
     */
    private function _rc_rename($src, $dst)
    {
        if ($src == $dst) {
            return $this->rename($src . "{" . $src . "}", $src);
        }
        if (!$this->exists($src)) {
            return $this->rename($src . "{" . $src . "}", $src);
        }

        $this->del($dst);
        $ktype = $this->type($src);
        $kttl = $this->ttl($src);

        if (!$ktype) {
            return false;
        }

        if ($ktype == \Redis::REDIS_STRING) {
            $this->set($dst, $this->get($src));
        } elseif ($ktype == \Redis::REDIS_HASH) {
            $this->hmset(dst, $this->hgetall($src));
        } elseif ($ktype == \Redis::REDIS_LIST) {
            $list = $this->lrange($src, 0, -1);
            foreach ($list as $k) {
                $this->rpush($dst, $k);
            }
        } elseif ($ktype == \Redis::REDIS_SET) {
            $set = $this->smembers($src);
            foreach ($set as $k) {
                $this->sadd($dst, k);
            }
        } elseif (ktype == \Redis::REDIS_ZSET) {
            $zset = $this->zrange($src, 0, -1, true);
            foreach ($zset as $k => $v) {
                $this->zadd($dst, $v, $k);
            }
        }

        # Handle keys with an expire time set
        if ($kttl > 0) {
            $this->expire($dst, $kttl);
        }

        return (bool) $this->del($src);
    }

    /**
     * Rename key ``$src`` to ``$dst`` if ``$dst`` doesn't already exist
     *
     * @param string $src the source set
     * @param string $dst the destination set
     *
     * @return bool
     */
    private function _rc_renamenx($src, $dst)
    {
        if ($this->exists($dst)) {
            return false;
        }

        return $this->_rc_rename($src, $dst);

    }

    /**
     * Returns a list of keys matching ``pattern``
     *
     * @param string $pattern the pattern
     *
     * @return array
     */
    private function _rc_keys($pattern = '*')
    {
        $result = array();
        foreach ($this->_redises as $alias => $redisent) {
            if (stripos($alias, '_slave') === false) {
                continue;
            }

            $result = array_merge($result, $redisent->keys($pattern));
        }

        return $result;
    }

    /**
     * Returns a list of keys matching ``pattern``
     *
     * @return int
     */
    private function _rc_dbsize()
    {
        $result = 0;
        foreach ($this->_redises as $alias => $redisent) {
            if (stripos($alias, '_slave') === false) {
                continue;
            }

            $result += $redisent->dbsize();
        }

        return $result;

    }

}