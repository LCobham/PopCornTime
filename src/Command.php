<?php namespace Acme;

use GuzzleHttp\Client;
use Symfony\Component\Console\Command\Command as SymfonyCommand;


class Command extends SymfonyCommand {
    protected $client;
    protected $baseURL;

    public function __construct()
    {
        $api_key = getenv('API_KEY');
        $this->baseURL = "https://www.omdbapi.com/?apikey={$api_key}";

        $this->client = new Client([
            'timeout' => TIMEOUT
        ]);

        parent::__construct();

        return $this;
    }
}
