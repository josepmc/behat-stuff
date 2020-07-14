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
        assert($_ENV['HOST'] !== null, "Define HOST as an environment variable");
        assert($_ENV['FORM_ID'] !== null, "Define FORM_ID as an environment variable");
        $this->visit($_ENV['HOST'] . $_ENV['FORM_ID']);
    }
}

$dotenv = Dotenv\Dotenv::createImmutable(getcwd(), ".env");
$dotenv->load();
