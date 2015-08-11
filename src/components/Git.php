<?php

namespace app\components;

/**
 * Git
 * @package app\components
 */
class Git
{
    /**
     * @param string $endpoint
     * @param string $file
     * @return bool|string
     */
    public static function getFile($endpoint, $file = null)
    {
        $url = self::getUrl($endpoint, $file);
        if ($url) {
            return @file_get_contents($url);
        }
        return false;
    }

    /**
     * @param string $endpoint
     * @param string $file
     * @return string
     */
    public static function getUrl($endpoint, $file = null)
    {
        if (strpos($endpoint, 'github.com')) {
            return strtr($endpoint, [
                'https://' => $file ? 'https://raw.' : 'https://',
                'http://' => $file ? 'https://raw.' : 'https://',
                'git://' => $file ? 'https://raw.' : 'https://',
                'github.com' => $file ? 'githubusercontent.com' : 'github.com',
                '.git' => $file ? '/master/' . $file : '',
            ]);
        }
        if (strpos($endpoint, 'repo.or.cz')) {
            return strtr($endpoint, [
                'https://' => 'http://',
                'git://' => 'http://',
                '.git' => $file ? '.git/blob_plain/master:/' . $file : '.git',
            ]);
        }
        return strtr($endpoint, [
            'http://' => 'https://',
            'git://' => 'https://',
            '.git' => $file ? '/raw/master/' . $file : '',
        ]);
    }

    /**
     * @param string $endpoint
     * @param string $format
     * @param string $version
     * @return string
     */
    public static function getDownload($endpoint, $format = 'zip', $version = 'master')
    {
        if (strpos($endpoint, 'github.com')) {
            return strtr($endpoint, [
                'http://' => 'https://',
                'git://' => 'https://',
                '.git' => '/archive/' . $version . '.' . $format,
            ]);
        }
        if (strpos($endpoint, 'repo.or.cz')) {
            return strtr($endpoint, [
                'https://' => 'http://',
                'git://' => 'http://',
                '.git' => '.git/snapshot/' . $version . '.' . $format,
            ]);
        }
        return strtr($endpoint, [
            'http://' => 'https://',
            'git://' => 'https://',
            '.git' => '/get/' . $version . '.' . $format,
        ]);
    }

}