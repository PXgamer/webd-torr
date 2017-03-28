<?php

namespace pxgamer\wdTorr\Routes;

use pxgamer\Generic\Inclusions;
use pxgamer\wdTorr\helpers\Content;

class Main extends Inclusions
{
    public function index()
    {
        $Content = new Content();
        $posters = $Content->getPosters();

        $this->S->display(
            'index.tpl',
            [
                'posters' => $posters
            ]
        );
    }
}
