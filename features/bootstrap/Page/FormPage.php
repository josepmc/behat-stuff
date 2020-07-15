<?php

namespace Page;

use SensioLabs\Behat\PageObjectExtension\PageObject\Page;

class FormPage extends Page
{
    use SharedPage;
    private $selectors = [
        "checkBox" => './/input[following-sibling::label[text()="%s"]]',
        "section" => './/fieldset[.//legend[text()="%s"]]',
        "email" => './/label[text()="Your email"]/following::input[1]',
        "submit" => './/*[@id="submit_button"]',
        "result" => './/*[@class="errMsg"]/span',
        "uploadField" => './/*[@title="Attach Picture"]'
    ];

    /**
     * Composes a checkbox locator
     */
    private function checkbox($name)
    {
        return sprintf($this->selectors["checkBox"], $name);
    }

    /**
     * Composes a section locator
     */
    private function section($name)
    {
        return sprintf($this->selectors["section"], $name);
    }

    /**
     * Toggles a specific checkbox
     */
    public function toggleCheckbox($name)
    {
        $this->xpath($this->checkbox($name))->click();
    }

    /**
     * Returns whether a section is displayed
     */
    public function isSectionDisplayed($name): bool
    {
        $element = $this->xpath($this->section($name));
        return $element !== null && $element->isVisible();
    }

    /**
     * Inputs an email into the email field
     */
    public function inputEmail($email)
    {
        $element = $this->xpath($this->selectors["email"]);
        $element->setValue($email);
    }

    /**
     * Submits the form
     */
    public function submit()
    {
        $this->xpath($this->selectors["submit"])->click();
        if ($this->isAlertPresent()) {
            $this->dismissAlert();
        }
    }

    /**
     * Returns the submission result
     */
    public function submissionResult(): ?string
    {
        $element = $this->xpath($this->selectors["result"]);
        return $element === null ? null : $element->getText();
    }

    /**
     * Adds a file to upload
     */
    public function uploadFile($file)
    {
        $this->xpath($this->selectors["uploadField"])->setValue($file);
    }
}
