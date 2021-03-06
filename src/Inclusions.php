<?php

namespace pxgamer\Generic;

use pxgamer\wdTorr\Smarter;

/**
 * Class Inclusions
 * @package pxgamer\Generic
 */
class Inclusions
{
    /**
     * @var \Smarty
     */
    public $S;

    /**
     * @var \SQLite3
     */
    public $SL3;

    /**
     * Main constructor.
     */
    public function __construct()
    {
        $this->S = Smarter::get();
        $this->SL3 = new \SQLite3(SQL_LITE_DB_PATH);

        // Check if SQLite3 Database exists, by checking for the `settings` table
        $stmt = $this->SL3->query("SELECT name FROM sqlite_master WHERE type = 'table' AND name = 'settings'");

        // If it doesn't exist, create it
        if (!$stmt->fetchArray()) {
            // Add the `settings` and `torrents` tables
            $this->SL3->exec('CREATE TABLE settings (version STRING, tmdb_api_key STRING, torrent_file_dir STRING, torrent_download_dir STRING, default_torrent_site STRING)');
            $this->SL3->exec('CREATE TABLE torrents (hash STRING UNIQUE PRIMARY KEY, title STRING, status STRING, percentage INT, completed BOOLEAN)');
            $this->SL3->exec("INSERT INTO settings (tmdb_api_key, default_torrent_site) VALUES ('', 'WorldWideTorrents')");
        }
    }

    /**
     * @param object $array
     * @return $this
     */
    public function setVars($array)
    {
        foreach ($array as $key => $var) {
            $this->$key = $var;
        }
        return $this;
    }

    /**
     * @param $time
     * @param string $format
     *
     * @return false|string
     */
    function absolute_time($time, $format = '')
    {
        if (!$time) {
            return 'N/A';
        }
        if (!ctype_digit($time)) {
            $time = strtotime($time);
        }
        if (!$format) {
            $format = 'j M o, g:i:sA';
        }

        return date($format, $time);
    }

}