<?php

namespace App\Controller;

use Cake\Http\Client;
use Cake\Http\Response;
use Cake\Filesystem\File;

/**
 * Songs Controller.
 *
 * @property \App\Model\Table\SongsTable $Songs
 *
 * @method \App\Model\Entity\Song[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SongsController extends AppController
{
    /**
     * Get all songs method.
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->set('response', $this->paginate($this->Songs));
        $this->set('_serialize', ['response']);
        $this->RequestHandler->renderAs($this, 'json');
    }

    /**
     * Add Song method.
     *
     * @return \Cake\Http\Response json
     */
    public function postMusic()
    {
        $music = $this->Songs->newEntity();
        if ($this->request->is('post')) {
            if (isset($this->request->getData()['music'])) {
                $nameFile = $this->request->getData()['music']['name'];
                if (strpos($nameFile, '-') !== false && strpos($nameFile, '.mp3') !== false) {
                    $dateMusic = $this->getMusicApi($nameFile);
                    $js = json_decode($dateMusic);
                    $music->music = $nameFile;
                    $music->title = $js->track->name ? $js->track->name : 'not registered';
                    $music->artist = $js->track->album->artist ? $js->track->album->artist : 'not registered';
                    $music->album = $js->track->album->title ? $js->track->album->title : 'not registered';
                    $music->cover = $js->track->album->image[3]->{'#text'} ? $js->track->album->image[3]->{'#text'} : 'not registered';

                    if ($this->Songs->save($music)) {
                        $this->set([
                            'message' => 'Music registered successfully',
                            'music' => $music,
                            '_serialize' => ['message', 'music'],
                        ]);
                    } else {
                        $this->response->statusCode(500);
                        $this->set([
                            'message' => 'Error while trying to save song!',
                            '_serialize' => ['message'],
                        ]);
                    }
                } else {
                    $this->response->statusCode(400);
                    $this->set([
                        'message' => 'Invalid filename, send artist-music.mp3',
                        '_serialize' => ['message'],
                    ]);
                }
            } else {
                $this->response->statusCode(400);
                $this->set([
                    'message' => 'File not sent',
                    '_serialize' => ['message'],
                ]);
            }
            $this->RequestHandler->renderAs($this, 'json');
        }
    }

    /**
     * Private method for retrieving API data.
     *
     * @param string $nameFile
     *
     * @return json $response->body
     */
    private function getMusicApi(string $nameFile)
    {
        $partsFile = explode('-', $nameFile);
        $artist = trim($partsFile[0]);
        $partsFileMusic = explode('.', $partsFile[1]);
        $track = trim($partsFileMusic[0]);

        $http = new Client();
        $urlAPI = 'http://ws.audioscrobbler.com/2.0/?';
        $tokenAPI = env('API_KEY', null);
        $response = $http->get($urlAPI, [
            'api_key' => $tokenAPI,
            'method' => 'track.getInfo',
            'artist' => $artist,
            'track' => $track,
            'autocorrect' => '0',
            'format' => 'json',
        ]);

        return $response->body;
    }
}
