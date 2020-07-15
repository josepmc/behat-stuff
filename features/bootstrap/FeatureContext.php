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
        assert(getenv("HOST") !== false, "Define HOST as an environment variable");
        assert(getenv("FORM_ID") !== false, "Define FORM_ID as an environment variable");
        $this->visit(getenv("HOST") . getenv("FORM_ID"));
    }
}

$envFile = getcwd() . "/.env";
if (file_exists($envFile)) {
    $dotenv = Dotenv\Dotenv::createUnsafeImmutable(getcwd(), ".env");
    $dotenv->load();
}
