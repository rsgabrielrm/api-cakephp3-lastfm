# Instalation
clone the github repository
```sh
$ git clone https://github.com/rsgabrielrm/api-cakephp3-lastfm.git
```
Enter the application folder
```sh
$ cd api-cakephp3-lastfm
```

Install dependencies
```sh
$ composer install
```

Clone and edit .env
#DB: Database settings
#API: Your access key to api last.fm
```sh
$ cp config/.env.default config/.env
$ vim config/.env
```

Run Migrations
```sh
$ bin/cake migrations migrate
```

Start App
```sh
$ bin/cake server
```

#Documentation
**Post Music**
Send music, search the data in api lastfm and return record saved in the database

```
    POST /songs
```
Do not send data in the request header
You have to send a body containing type form-data
```
    key music type File
    value artist-music.mp3
```

Return music
```json
{
    "message": "Music registered successfully",
    "music": {
        "music": "Ramones-Blitzkrieg Bop.mp3",
        "title": "Blitzkrieg Bop",
        "artist": "Ramones",
        "album": "Ramones",
        "cover": "https://lastfm-img2.akamaized.net/i/u/300x300/32b61b03e34a4e8a91d3bb0dea72a5b4.png",
        "created": "2018-12-03T00:57:24+00:00",
        "modified": "2018-12-03T00:57:24+00:00",
        "id": 1
    }
}
```


**List Songs**
List all songs

```
    GET /songs
```

Returns all songs
```json
{
    "response": [
        {
            "id": 1,
            "artist": "Ramones",
            "title": "Blitzkrieg Bop",
            "album": "Ramones",
            "cover": "https://lastfm-img2.akamaized.net/i/u/300x300/32b61b03e34a4e8a91d3bb0dea72a5b4.png",
            "music": "Ramones-Blitzkrieg Bop.mp3",
            "created": "2018-12-03T00:57:24+00:00",
            "modified": "2018-12-03T00:57:24+00:00"
        },
        {
            "id": 2,
            "artist": "Eminem",
            "title": "Not Afraid",
            "album": "Recovery",
            "cover": "https://lastfm-img2.akamaized.net/i/u/300x300/d15881b09b6041ccad34c2490de618b3.png",
            "music": "Eminem - Not Afraid.mp3",
            "created": "2018-12-03T00:59:12+00:00",
            "modified": "2018-12-03T00:59:12+00:00"
        }
    ]
}
```
