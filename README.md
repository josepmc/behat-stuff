## Introduction

This is a sample PHP test using Mink+Behat.

### Installation

Get composer installed and run `php composer install`.

Afterwards, download the selenium server and chromedriver to the same folder.
Alternatively, you can use a docker image to run the selenium server, like this: `docker run -d -p 4444:4444 -v /dev/shm:/dev/shm -v $(pwd):/behat selenium/standalone-chrome`. Please note that you will also need `export CI="true"` for all the tests to work.

### Run the tests

Define a .env file containing the following:

- HOST: The host server that the tests will target
- FORM_ID: The id of the form the tests will target
- FAVOURITE_FOOD: Your favourite food! :sushi:
- EMAIL_SENDER: The account that sends the emails

Start your selenium server using `java -jar selenium*.jar`.
You can run the tests using `./bin/behat`.

### Notes

These tests are using guerrilla mail's API underneath. Please note that this is a **free** service and they do have rate limiting. Don't be a bully!
