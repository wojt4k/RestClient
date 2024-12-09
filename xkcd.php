<?php
require ('RestClient.php');

class xkcd
{
	private $client;
	private $meme;
	public function __construct($memeId = null)
	{
	    $memeId = $memeId !== null ? $memeId : rand(1,365);
        $this->client = new RestClient('https://xkcd.com/');
        $this->getMeme($memeId);
        $this->showMeme();
    }

	public function getMeme( int $id )
	{
	    $this->meme = json_decode($this->client->get($id . '/info.0.json'));
	}

    public function showMeme()
    {
        $this->printText();
        $this->printImage();
    }

    private function printImage() {
        echo '<img src="'.$this->meme->img.'">';
    }

    private function printText() {
        echo '<h1>'.$this->meme->title.'</h1>';
        echo '<h5>'.$this->meme->alt.'</h5>';
        echo '<p>'.$this->cleanTransript().'</p>';
    }

    private function cleanTranscript(): string {
	    $pos = strpos($this->meme->transcript, '{{');
	    return substr($this->meme->transcript, 0, $pos);
    }

}
