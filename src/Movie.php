<?php namespace Acme;

class Movie {
    public string $title;
    public string $year;
    public array $info = [];

    public static function fromResponse(object $parsedResponse)
    {
        $movie = new Movie();

        $movie->title = $parsedResponse->Title;
        $movie->year = $parsedResponse->Year;

        unset($parsedResponse->Title);
        unset($parsedResponse->Year);
        unset($parsedResponse->Response);

        foreach($parsedResponse as $property => $value) {
            if (is_string($value)) {
                $movie->info[$property] = $value;
            }
        }

        return $movie;
    }
}
