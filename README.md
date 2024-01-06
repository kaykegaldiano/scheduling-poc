## Scheduling

This is a work in progress proof of concept of a simple scheduling.

## How to run this project

### Requirements

You only need to have Docker installed to run this project

### Steps
- Clone the project
- Clone .env.example to .env
- Run this command on terminal:

```shell
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs
```
- After processing is complete, run the command `./vendor/bin/sail up -d`
- Then run `./vendor/bin/sail art migrate --seed`
- Then run `./vendor/bin/sail npm run build`
- To stop the project, just run `./vendor/bin/sail stop`

Enjoy the project!
