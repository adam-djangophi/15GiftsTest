# 15 Gifts test exercise

## Prereqs

Make sure you have docker and docker-compose install on your machine

## Getting started

There is a make file to facilitate things

`make init` will build the docker image, container and run some first time setup

## Running the code
you need to exec into the container and run it from the command line

`make exec` - to exec into the docker container

once there you will need run the NumberToString command as such:

`php artisan 15gifts:numberToString:range --start=1 --end=100`

start and end can be set by, if omitted it will print a range of 1 to 1 million. End cannot be higher than start

## Tests

`make test` - There are unit tests from outside container

## Code sniffer 

Code adheres to code style standards

`make sniff` - runs the sniffer
`makes sniff-fix` - runs the sniffer and tries to fix any errors

## Static analysis

Uses PHPstan analyse code and show errors - All errors are fixed at time of commit

`make analyse`

# Code coverage 

Ordinarily I would not commit the code coverage report, in the reports directory.  You can view the report
from my runs at `reports/coverage/index.html`  

`make coverage` - generates the report

# Notes What I would do next

- I used laravel to demonstrate my experience with frameworks.  The words array can be found in `config/services.php`
- The words array is injected into the the `app/Services/NumberConvertor.php` service via the 
   `app/Providers/AppServiceProvider.php`
- Given more time I would clean up the repo and remove the extraneous files
- Given more time I would look at shortening the number converter class and extracting out the functionality, more for 
  readabilty, the service is 100% covered by tests.
- Given more times I would perhaps provide an endpoint which can can be called, via a GET request.