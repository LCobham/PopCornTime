<?php namespace Acme;

use Symfony\Component\Console\Input\InputInterface;

class URL {
    public $url;
    protected $input;

    public function __construct(InputInterface $input)
    {
        $key = getenv('API_KEY');

        $this->url = "https://www.omdbapi.com/?apikey={$key}";
        $this->input = $input;

        return $this;
    }

    public function addMovie()
    {
        $movie = $this->input->getArgument('movie');

        $this->url = "{$this->url}&t={$movie}";

        return $this;
    }

    public function addOption(string $name, string $queryParamKey, string $paramValue = '')
    {
        $option = $this->input->getOption($name);

        if ($option) {
            $paramValue = ($paramValue === '') ? $option : $paramValue;

            $this->url = "{$this->url}&{$queryParamKey}={$paramValue}";
        }

        return $this;
    }
}