<?php

namespace pxgamer\Generic;

use pxgamer\wdTorr\Smarter;

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
            $this->SL3->exec('CREATE TABLE settings (version STRING, tmdb_api_key STRING, torrent_file_dir STRING, torrent_download_dir STRING)');
            $this->SL3->exec('CREATE TABLE torrents (hash STRING UNIQUE PRIMARY KEY, title STRING, status STRING, percentage INT, completed BOOLEAN)');
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
}