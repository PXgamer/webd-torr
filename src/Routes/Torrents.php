<?php

namespace pxgamer\wdTorr\Routes;

use pxgamer\Generic\Inclusions;

/**
 * Class Torrents
 * @package pxgamer\wdTorr\Routes
 *
 * @property \System\Request request
 */
class Torrents extends Inclusions
{
    public function index()
    {
        $result = $this->SL3->query('SELECT * FROM torrents');
        $torrents = $result->fetchArray();

        $this->S->display(
            'torrents/index.tpl',
            [
                'torrents' => $torrents
            ]
        );
    }
}
