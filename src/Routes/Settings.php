<?php

namespace pxgamer\wdTorr\Routes;

use pxgamer\Generic\Inclusions;

class Settings extends Inclusions
{
    public function index()
    {
        $this->S->display(
            'settings/index.tpl',
            []
        );
    }
}
