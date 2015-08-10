<?php

namespace app\components;

use yii\base\Object;

/**
 * Serialize
 */
class Serialize extends Object
{
    /**
     * Convert the given value into a gzip compressed blob so it can be stored in the database
     * @param mixed $data
     * @return string               binary blob of data
     */
    public static function serialize($data)
    {
        return self::compress(serialize($data));
    }

    /**
     * Re-inflates and unserializes a blob of compressed data
     * @param string $data
     * @return mixed            false if an error occurred
     */
    public static function unserialize($data)
    {
        if (is_resource($data)) {
            // For some databases (like Postgres) binary columns return as a resource, fetch the content first
            $data = stream_get_contents($data, -1, 0);
        }

        $originalData = $data;
        $data = self::uncompress($data);

        if ($data === false) {
            $data = $originalData;
        }

        $data = @unserialize($data);
        if ($data === false) {
            $data = $originalData;
        }

        return $data;
    }

    /**
     * Compress
     * @param mixed $data
     * @return string binary blob of data
     */
    public static function compress($data)
    {
        return gzcompress($data);
    }

    /**
     * Compress
     * @param mixed $data
     * @return string binary blob of data
     */
    public static function uncompress($data)
    {
        $originalData = $data;
        $data = @gzuncompress($data);
        return $data ?: $originalData;
    }

}