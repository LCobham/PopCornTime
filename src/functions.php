<?php

function loadDotEnv(string $pathToEnv)
{
    $env = file_get_contents($pathToEnv);

    $lines = explode('\n', $env);

    foreach($lines as $line) {
        putenv(trim($line));
    }
}
