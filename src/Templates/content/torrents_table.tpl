{if isset($torrents)}
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
                <td>{$torrent['publish_date']|absolute_time:'jS M Y'}</td>
                <td>{$torrent['size']}</td>
                <td>{$torrent['seeders']}</td>
                <td>{$torrent['leechers']}</td>
                <td><a href="{$torrent['magnet']}"><span class="fa fa-fw fa-rotate-180 fa-magnet"></span></a></td>
            </tr>
        {/foreach}
        </tbody>
    </table>
{/if}