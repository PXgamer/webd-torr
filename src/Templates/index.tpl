{include file='include/header.tpl'}
<div class="container">
    {$posters}
    <form action="" method="post" class="pull-right panel-group">
        <input type="submit" name="refresh_cache_data" title="Refresh Cache" class="btn btn-default"
               value="Refresh Cache"/>
    </form>
</div>
{include file='include/footer.tpl'}