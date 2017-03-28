<?php

namespace pxgamer\wdTorr\Routes;

use pxgamer\Generic\Inclusions;

/**
 * Class Generic
 */
class Generic extends Inclusions
{
    /**
     * @param int $error_code
     * @param null|string $error_text
     */
    public function error($error_code, $error_text = null)
    {
        $this->S->display(
            'generic/error.tpl',
            [
                'error_code' => $error_code,
                'error_text' => $error_text
            ]
        );
    }
}
