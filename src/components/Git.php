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
    public static function getFile($endpoint, $file = null)
    {
        $url = self::getUrl($endpoint, $file);
        if ($url) {
            return @file_get_contents($url);
        }
        return false;
    }

    /**
     * @param $endpoint
     * @param $file
     * @return string
     */
    public static function getUrl($endpoint, $file = null)
    {
        if (strpos($endpoint, 'github.com')) {
            return self::getGitHubComUrl($endpoint, $file);
        }
        if (strpos($endpoint, 'repo.or.cz')) {
            return self::getRepoOrCzUrl($endpoint, $file);
        }
        return strtr($endpoint, [
            'http://' => 'https://',
            'git://' => 'https://',
            '.git' => $file ? '/raw/master/' . $file : '',
        ]);
    }

    /**
     * @param $endpoint
     * @param $file
     * @return string
     */
    private static function getGitHubComUrl($endpoint, $file)
    {
        return strtr($endpoint, [
            'https://' => $file ? 'https://raw.' : 'https://',
            'http://' => $file ? 'https://raw.' : 'https://',
            'git://' => $file ? 'https://raw.' : 'https://',
            '.git' => $file ? '/master/' . $file : '',
        ]);
    }

    /**
     * @param $endpoint
     * @param $file
     * @return string
     */
    private static function getRepoOrCzUrl($endpoint, $file)
    {
        return strtr($endpoint, [
            'http://' => 'http://',
            'git://' => 'http://',
            '.git' => $file ? '.git/blob_plain/master:/' . $file : '.git',
        ]);
    }

}