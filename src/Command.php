<?php namespace Acme;

use GuzzleHttp\Client;
use Symfony\Component\Console\Command\Command as SymfonyCommand;


class Command extends SymfonyCommand {
    protected $client;
    protected $base_url;

    public function __construct()
    {
        $api_key = getenv('API_KEY');
        $this->base_url = "https://www.omdbapi.com/?apikey={$api_key}";

        $this->client = new Client([
            'timeout' => TIMEOUT
        ]);

        parent::__construct();

        return $this;
    }
}