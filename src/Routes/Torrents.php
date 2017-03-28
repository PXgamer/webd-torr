<?php

namespace pxgamer\wdTorr\Routes;

use pxgamer\Generic\Inclusions;

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
