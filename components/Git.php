<?php

namespace app\components;

/**
 * Git
 * @package app\components
 */
class Git
{
    /**
     * @param $endpoint
     * @param $file
     * @return bool|string
     */
    public static function get($endpoint, $file)
    {
        if (strpos($endpoint, 'github.com')) {
            return self::getGitHub($endpoint, $file);
        }
        if (strpos($endpoint, 'bitbucket.org')) {
            return self::getBitBucket($endpoint, $file);
        }
        return false;
    }

    /**
     * @param $endpoint
     * @param $file
     * @return string
     */
    private static function getGitHub($endpoint, $file)
    {
        $https = strtr($endpoint, [
            'git://' => 'https://raw.',
            '.git' => '/master/' . $file,
        ]);
        return @file_get_contents($https);
    }

    /**
     * @param $endpoint
     * @param $file
     * @return string
     */
    private static function getBitBucket($endpoint, $file)
    {
        $https = strtr($endpoint, [
            'git://' => 'https://',
            '.git' => '/raw/master/' . $file,
        ]);
        return @file_get_contents($https);
    }
}