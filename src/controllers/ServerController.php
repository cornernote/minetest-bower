<?php

namespace app\controllers;

use DOMDocument;
use Yii;
use yii\web\Controller;

/**
 * Class PackageController
 * @package app\controllers
 */
class ServerController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        // get server results from servers.minetest.ru
        $dom = new DOMDocument();
        $dom->preserveWhiteSpace = false;
        $html = $dom->loadHTMLFile('http://servers.minetest.net/');
        $tables = $dom->getElementsByTagName('table');
        $rows = $tables->item(0)->getElementsByTagName('tr');
        $results = array();
        foreach ($rows as $row) {
            $cols = $row->getElementsByTagName('td');
            $result = array();
            foreach ($cols as $col) {
                $result[] = $col->nodeValue;
            }
            $results[] = $result;
        }

        // extract the server info
        $gi = geoip_open("GeoLiteCity.dat", GEOIP_STANDARD);
        $servers = array();
        foreach ($results as $result) {
            if (!$result) continue;
            list($host, $port) = explode(':', $result[0]);
            $geoip = geoip_record_by_addr($gi, gethostbyname($host));
            if (!$geoip) continue;
            $servers[] = array(
                'name' => $result[3],
                'host' => $host,
                'port' => $port,
                'lat' => $geoip->latitude,
                'lon' => $geoip->longitude,
                'site' => $result[2],
                'uptime' => $result[6],
            );
        }

        return $this->render('index');
    }

}
