<?php

use Behat\MinkExtension\Context\MinkContext;

/**
 * Features context.
 */
class FeatureContext extends MinkContext
{
    /**
     * @When I visit the test page
     */
    public function iVisitPage()
    {
        $url = $_ENV['URL'];
        assert($url !== null);
        $this->visit($url);
    }
}

$dotenv = Dotenv\Dotenv::createImmutable(getcwd(), ".env");
$dotenv->load();
