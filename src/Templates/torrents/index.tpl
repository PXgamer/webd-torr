{include file='include/header.tpl'}
<div class="container table-responsive">
    <table class="table table-striped table-hover">
        {if $torrents}
            {foreach $torrents as $torrent}
                <tr>
                    <td>
                        <h5>
                            {$torrent->title}
                            <small>{$torrent->hash}</small>
                        </h5>
                        <div class="btn-group form-group">
                            <span class="btn btn-success btn-xs">Start</span>
                            <span class="btn btn-info btn-xs">Pause</span>
                            <span class="btn btn-warning btn-xs">Stop</span>
                            <span class="btn btn-danger btn-xs">Delete</span>
                        </div>
                        <div class="progress progress-striped">
                            <div class="progress-bar progress-bar-{$torrent->status}"
                                 role="progressbar"
                                 aria-valuenow="{$torrent->percentage}"
                                 aria-valuemin="0"
                                 aria-valuemax="100"
                                 style="width:{$torrent->percentage}%"
                            >{$torrent->percentage}%
                            </div>
                        </div>
                    </td>
                </tr>
            {/foreach}
        {/if}
    </table>
</div>
{include file='include/footer.tpl'}