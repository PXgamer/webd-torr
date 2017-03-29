{include file='include/header.tpl'}
<div class="container">
    <h2>Settings</h2>
    <form action="/settings/" method="post">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>WDT Settings</h4>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="default_torrent_site">Default Torrent Site:</label>
                    <input class="form-control" type="text" name="default_torrent_site" id="default_torrent_site" value="{$default_torrent_site}">
                </div>
            </div>
            <div class="panel-heading">
                <h4>API Interworking</h4>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="tmdb_key">TMDb API Key:</label>
                    <input class="form-control" type="text" name="tmdb_key" id="tmdb_key" value="{$tmdb_key}">
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="pull-right">
                    <input type="submit" class="btn btn-success" value="Save Settings"/>
                </div>
            </div>
        </div>
    </form>
</div>
{include file='include/footer.tpl'}