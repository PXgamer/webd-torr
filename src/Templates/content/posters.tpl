{if $items && !isset($items->status_message)}
    <div class="panel panel-default">
        <div class="panel-heading"><h4>{$title|strtoupper}</h4></div>
        <div class="panel-body">
            {foreach $items as $item}
                {if $item && $item->poster_path}
                    <a href="/show/{$title}/{$item->id}" class="inline-block poster-section"
                       title="{if isset($item->title)}{$item->title}{else}{$item->name}{/if}">
                        <div class="poster-overlay-rating pull-right badge">
                            <span class="fa fa-fw fa-star"></span>{$item->vote_average}
                        </div>
                        <img src="//image.tmdb.org/t/p/w154/{$item->poster_path}"
                             class="poster-img img-rounded"
                             alt="{if isset($item->title)}{$item->title}{else}{$item->name}{/if}">
                        <div class="poster-overlay text-center">
                            <p>{if isset($item->title)}{$item->title}{else}{$item->name}{/if}</p>
                        </div>
                    </a>
                {/if}
            {/foreach}
        </div>
    </div>
{/if}