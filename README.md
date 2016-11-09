# webd-torr

An open-source, moddable torrent client.

## Installation

__webd-torr__ is extremely easy to install. All it requires is `curl` and `php 5.5+`.

1. Clone the repository to your web server using `git clone https://github.com/PXgamer/webd-torr.git`
2. Open the index.php in your browser
3. Run through the settings to get it connected to the database
4. Optionally add your TMDb (The Movie Database) API key to `/settings/` in order to get poster/new content access
5. All done

## Pages

__/ (`views/layout.phtml`)__

Currently there is nothing here, but in future a dashboard will be added.

__/myTorrents/ (`views/myTorrents.phtml`)__

Currently this will list all active torrents.

__/newContent/ (`views/newContent.phtml`)__

Currently, if an API key is provided for TMDb, it will list clickable posters for finding popular movies/tv and downloading different quality torrents for these.

__/settings/ (`views/settings.phtml`)__

Currently this has inputs for storing database details, and managing required API keys.