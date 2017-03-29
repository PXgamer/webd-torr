<?php

namespace pxgamer\wdTorr\Routes;

use pxgamer\Generic\Inclusions;

/**
 * Class Settings
 * @package pxgamer\wdTorr\Routes
 *
 * @property \System\Request request
 */
class Settings extends Inclusions
{
    public function index()
    {
        if (isset($this->request->body['tmdb_key'])) {
            $stmt = $this->SL3->prepare("UPDATE settings SET tmdb_api_key = :api_key");
            $stmt->bindValue(':api_key', $this->request->body['tmdb_key'], SQLITE3_TEXT);
            $stmt->execute();
        }
        if (isset($this->request->body['default_torrent_site'])) {
            $stmt = $this->SL3->prepare("UPDATE settings SET default_torrent_site = :default_torrent_site");
            $stmt->bindValue(':default_torrent_site', $this->request->body['default_torrent_site'], SQLITE3_TEXT);
            $stmt->execute();
        }

        $this->S->display(
            'settings/index.tpl',
            [
                'tmdb_key' => $this->SL3->querySingle('SELECT tmdb_api_key FROM settings'),
                'default_torrent_site' => $this->SL3->querySingle('SELECT default_torrent_site FROM settings')
            ]
        );
    }
}
