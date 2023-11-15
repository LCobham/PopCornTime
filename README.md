# PopCornTime! 🍿

## Intro
This repo consists of a PHP script (`moviepedia`) that works as a simple console app to retrieve information about movies.

## Install
Requirements: Php >= 8.1.0 & Composer

- `brew install php@8.1 composer` Mac OS X with brew
- `apt-get install php8.1` Ubuntu with apt-get (use sudo if is necessary)

This step is not necessary when you use Docker (a Dockerfile with all neccessary dependencies is included).


### Backend Installation

1. Clone GitHub repo for this project locally:

```
git clone https://github.com/LCobham/PopCornTime.git
```

2. cd into the cloned directory

```
cd PopCornTime
```

3. request an API KEY at http://www.omdbapi.com/apikey.aspx and add it to a .env file at the root of the cloned directory

```
echo "API_KEY=<your_key>" > .env
```

4. install the neccessary dependencies with composer

(If you have composer locally)
```
composer install
```

(If using Docker & the provided Dockerfile)
```
docker build . -t "popcorntime-php:latest"

docker run --rm \
    -it -w /app \
    -v $(pwd):/app \
    popcorntime-php:8.1 \
    /bin/bash

(inside the container)
composer install
```

5. run the app (from the root of the project)
(If php & composer installed locally)
```
./moviepedia

./moviepedia show scarface

./moviepedia show scarface --fullPlot
```

(If using docker)
```
docker run --rm \
    -it -w /app \
    -v $(pwd):/app \
    popcorntime-php:8.1 \
    /bin/bash
```

(inside the container)
```
./moviepedia

./moviepedia show scarface

./moviepedia show scarface --fullPlot
```
