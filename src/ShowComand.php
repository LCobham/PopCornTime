<?php namespace Acme;

use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


class ShowComand extends Command {

    public function configure()
    {
        $this->setName('show')
            ->setDescription('Shows the information about a specific movie')
            ->addArgument('movie', InputArgument::REQUIRED, 'Movie of which we\'re requesting information.')
            ->addOption('fullPlot', null, InputOption::VALUE_NONE,
                'Displays the complete plot of the movie, if available.')
            ->addOption('type', null, InputOption::VALUE_OPTIONAL,
                'Search only movies, series or episodes. [Avalable options: \'movie\', \'series\', \'episode\']', 'movie');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $url = (new URL($input))
            ->addMovie()
            ->addOption('fullPlot', 'plot', 'full')
            ->addOption('type', 'type')
            ->url;

        $movieInfo = $this->getMovieInfo($url, $output);

        if ($movieInfo->Response !== 'True') {
            $output->writeln($movieInfo->Error);
            
            return EXIT_FAILURE;
        }

        $output->writeln("<info>{$movieInfo->Title} - {$movieInfo->Year}</info>");
        $this->displayAsTable($movieInfo, $output);

        return EXIT_SUCCESS;
    }

    protected function getMovieInfo(string $url, OutputInterface $out)
    {

        $response = $this->client->get($url);
        $status = $response->getStatusCode();

        if ($status !== 200) {
            $out->writeln(
                "Oops! Looks like something went wrong ({$status})"
            );

            exit(EXIT_FAILURE);
        }

        return json_decode($response->getBody());
    }

    protected function displayAsTable(object $movie, OutputInterface $out)
    {
        $table = new Table($out);

        $rows = [];
        foreach($movie as $rowTitle => $rowInfo) {

            if (gettype($rowInfo) === "string" || gettype($rowInfo) === "int" ) {

                $columns = getenv('COLUMNS') ?? 40; // Get number of cols in the terminal window
                $rowTitleWidth = 18;
                $max_width = ($columns - $rowTitleWidth > 20)? $columns - $rowTitleWidth: 20;
    
                $rows[] = [$rowTitle, wordwrap($rowInfo, $max_width)];
            }
        }

        $table->setRows($rows)
            ->render();
    }
}