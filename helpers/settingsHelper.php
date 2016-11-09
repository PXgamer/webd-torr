<?php

class settingsHelper
{
    public function __construct()
    {
    }

    public function viewReplace($templateContent, $torrentsList = [])
    {
        return preg_replace('/\{\{settingsForm\}\}/', self::createSettingsForm(), $templateContent);
    }

    private static function createSettingsForm()
    {
        $content = '
        <div>
          <h2>Settings</h2>
          <form action="/settings/" method="post">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4>Database</h4>
              </div>
              <div class="panel-body">
                <div class="form-group">
                  <label for="db_host">Host:</label><input class="form-control" type="text" name="db_host" id="db_host">
                </div>
                <div class="form-group">
                  <label for="db_user">Username:</label><input class="form-control" type="text" name="db_user" id="db_user">
                </div>
                <div class="form-group">
                  <label for="db_pass">Password:</label><input class="form-control" type="password" name="db_pass" id="db_pass">
                </div>
                <div class="form-group">
                  <label for="db_name">Database:</label><input class="form-control" type="text" name="db_name" id="db_name">
                </div>
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4>API Interworking</h4>
              </div>
              <div class="panel-body">
                <div class="form-group">
                  <label for="tmdb_key">TMDb API Key:</label><input class="form-control" type="text" name="tmdb_key" id="tmdb_key">
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
        ';

        return $content;
    }
}
