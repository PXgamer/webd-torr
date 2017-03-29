{include file='include/header.tpl'}
<div class="container">
    <div class="page-header">
        <h1>{if isset($meta->name)}{$meta->name}{else}{$meta->title}{/if}</h1>
    </div>
    <div class="panel-group">
        <table class="table table-unstyled">
            <tr>
                <td>
                    <img src="{if $meta->poster_path}//image.tmdb.org/t/p/w185/{$meta->poster_path}{else}/assets/img/poster_not_found.png{/if}"
                         class="poster-img img-rounded"
                         alt="{if isset($meta->title)}{$meta->title}{else}{$meta->name}{/if}">
                </td>
                <td>
                    <h4>Summary</h4>
                    <p>{$meta->overview}</p>
                </td>
            </tr>
        </table>

        <h4>Information:</h4>
        <table class="table">
            <tr>
                <th>Genres:</th>
                {$i = 0}
                <td>
                    {if !$meta->genres}
                        <span class="text-warning">N/A</span>
                    {/if}
                    {foreach $meta->genres as $item}{if $i > 0}, {/if}{$item->name}{$i=$i+1}{/foreach}
                </td>
            </tr>
            {if $type == 'movie'}
                <tr>
                    <th>Release Date:</th>
                    <td>{$meta->release_date|absolute_time:'jS M Y'}</td>
                </tr>
            {elseif $type == 'tv'}
                <tr>
                    <th>First Aired:</th>
                    <td>{$meta->first_air_date|absolute_time:'jS M Y'}</td>
                </tr>
                <tr>
                    <th>Last Aired:</th>
                    <td>{$meta->last_air_date|absolute_time:'jS M Y'}</td>
                </tr>
                <tr>
                    <th>Seasons:</th>
                    <td>{$meta->number_of_seasons}</td>
                </tr>
                <tr>
                    <th>Episodes:</th>
                    <td>{$meta->number_of_episodes}</td>
                </tr>
                <tr>
                    <th>Networks:</th>
                    {$i = 0}
                    <td>
                        {if !$meta->networks}
                            <span class="text-warning">N/A</span>
                        {/if}
                        {foreach $meta->networks as $item}{if $i > 0}, {/if}{$item->name}{$i=$i+1}{/foreach}
                    </td>
                </tr>
            {/if}
            <tr>
                <th>Production Companies</th>
                {$i = 0}
                <td>
                    {if !$meta->production_companies}
                        <span class="text-warning">N/A</span>
                    {/if}
                    {foreach $meta->production_companies as $item}{if $i > 0}, {/if}{$item->name}{$i=$i+1}{/foreach}
                </td>
            </tr>
        </table>
    </div>
    <div class="panel-group">
        <h4>External Links</h4>
        <ul class="list-inline">
            {if $meta->homepage}
                <li>
                    <a class="btn btn-xs btn-default" href="{$meta->homepage}" target="_blank">Homepage</a>
                </li>
            {/if}
            {if isset($meta->imdb_id)}
                <li>
                    <a class="btn btn-xs btn-default" href="//imdb.com/title/{$meta->imdb_id}" target="_blank">IMDb</a>
                </li>
            {/if}
            <li>
                <a class="btn btn-xs btn-default" href="//tmdb.org/{$type}/{$meta->id}" target="_blank">TMDb</a>
            </li>
        </ul>
    </div>
    <div class="panel-group">
        {include file='content/torrents_table.tpl' torrents=$torrents}
    </div>
</div>
{include file='include/footer.tpl'}