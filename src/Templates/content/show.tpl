{include file='include/header.tpl'}
<div class="container">
    <div class="page-header">
        <h1>{if isset($meta->name)}{$meta->name}{else}{$meta->title}{/if}</h1>
    </div>
    <div class="panel-group">
        <div class="inline-block panel-group">
            <div class="inline-block">
                <img src="//image.tmdb.org/t/p/w185/{$meta->poster_path}"
                     class="poster-img img-rounded"
                     alt="{if isset($meta->title)}{$meta->title}{else}{$meta->name}{/if}">
            </div>
            <div class="inline-block">
                <h4>Summary</h4>
                <p>{$meta->overview}</p>
            </div>
        </div>
        {foreach $meta->genres as $genre}
            <span class="badge">{$genre->name}</span>
        {/foreach}

        <h4>Information:</h4>
        <table class="table">
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
                        {foreach $meta->networks as $item}
                            {if $i > 0}, {/if}
                            {$i = $i++}
                            {$item->name}
                        {/foreach}
                    </td>
                </tr>
            {/if}
            <tr>
                <th>Production Companies</th>
                {$i = 0}
                <td>
                    {foreach $meta->production_companies as $item}
                        {if $i > 0}, {/if}
                        {$i = $i++}
                        {$item->name}
                    {/foreach}
                </td>
            </tr>
        </table>
    </div>
    <div class="panel-group">
        <h4>External Links</h4>
        <ul class="list-inline">
            {if $meta->homepage}
                <li><a href="{$meta->homepage}" target="_blank">Homepage</a></li>
            {/if}
            {if isset($meta->imdb_id)}
                <li><a href="//imdb.com/title/{$meta->imdb_id}" target="_blank">IMDb</a></li>
            {/if}
            <li><a href="//tmdb.org/{$type}/{$meta->id}" target="_blank">TMDb</a></li>
        </ul>
    </div>
</div>
{include file='include/footer.tpl'}