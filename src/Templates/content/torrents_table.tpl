<h4>Torrents</h4>
{if isset($torrents) && !empty($torrents)}
    <table class="table table-unstyled">
        <thead>
        <tr>
            <th>Title</th>
            <th>Category</th>
            <th>Uploaded</th>
            <th>Size</th>
            <th>Seeds</th>
            <th>Leeches</th>
            <th>Download</th>
        </tr>
        </thead>
        <tbody>
        {foreach $torrents as $torrent}
            <tr>
                <td><a href="{$torrent['link']}" target="_blank">{$torrent['title']}</a></td>
                <td>{$torrent['category']}</td>
                <td>{if isset($torrent['publish_date'])}{$torrent['publish_date']|absolute_time:'jS M Y'}{else}{$torrent['pubDate']|absolute_time:'jS M Y'}{/if}</td>
                <td>{$torrent['size']|file_size}</td>
                <td>{$torrent['seeders']}</td>
                <td>{$torrent['leechers']}</td>
                <td><a href="{if isset($torrent['magnetURI'])}{$torrent['magnetURI']}{else}{$torrent['magnet']}{/if}"><span class="fa fa-fw fa-rotate-180 fa-magnet"></span></a></td>
            </tr>
        {/foreach}
        </tbody>
    </table>
{else}
    <div class="alert alert-warning">
        <p>No torrents found.</p>
    </div>
{/if}