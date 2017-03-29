{include file='include/header.tpl'}
<div class="container">
    <div class="page-header">
        <h1>{if isset($meta->name)}{$meta->name}{else}{$meta->title}{/if}</h1>
    </div>
    <div>
        <div class="inline-block">
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
        <div>
            {foreach $meta->genres as $genre}
                <span class="badge">{$genre->name}</span>
            {/foreach}
        </div>
    </div>
    <div>
        <h4>External Links</h4>
        <ul class="list-inline">
            <li><a href="//imdb.com/title/{$meta->imdb_id}">IMDb</a></li>
            <li><a href="//tmdb.org/{$meta->id}">TMDb</a></li>
        </ul>
    </div>
</div>
{include file='include/footer.tpl'}