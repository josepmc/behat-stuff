<?php

use Behat\Behat\Context\Context;
use Page\FormPage;

class FormValidation implements Context
{
    private $form;

    public function __construct(FormPage $form)
    {
        $this->form = $form;
    }

    private function favouriteFood()
    {
        assert($_ENV['FAVOURITE_FOOD'] !== null, "Define FAVOURITE_FOOD as an environment variable");
        return $_ENV['FAVOURITE_FOOD'];
    }

    /**
     * @When I (un)check the favorite food option
     */
    public function iCheckTheFavoriteFoodOption()
    {
        $this->form->toggleCheckbox($this->favouriteFood());
    }

    /**
     * @Then I should see the favorite food section
     */
    public function iShouldSeeTheSection()
    {
        assert($this->form->isSectionDisplayed($this->favouriteFood()));
    }

    /**
     * @Then I should not see the favorite food section
     */
    public function iShouldNotSeeTheFieldSection()
    {
        assert(!$this->form->isSectionDisplayed($this->favouriteFood()));
    }
}
