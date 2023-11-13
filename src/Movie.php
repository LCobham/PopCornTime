<?php namespace Acme;

use Psr\Http\Message\ResponseInterface;

class Movie {
    public string $Title, $Year, $Response;
    public array $info = [];

    public function __construct(ResponseInterface $response)
    {
        $parsed = json_decode($response->getBody());

        $this->Title = $parsed->Title;
        $this->Year = $parsed->Year;
        $this->Response = $parsed->Response;

        unset($parsed->Title);
        unset($parsed->Year);
        unset($parsed->Response);

        foreach($parsed as $property => $value) {
            if (gettype($value) === 'string' || gettype($value) === 'int') {
                $this->info[$property] = $value;
            }
        }

        return $this;
    }
}