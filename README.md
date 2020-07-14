## Introduction

This is a sample PHP test using Mink+Behat.

### Installation

Get composer installed and run `php composer install`.
Afterwards, download the selenium server and chromedriver to the same folder.

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
