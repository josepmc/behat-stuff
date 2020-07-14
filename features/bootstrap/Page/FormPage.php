<?php

namespace Page;

use SensioLabs\Behat\PageObjectExtension\PageObject\Page;

class FormPage extends Page
{
    use SharedPage;
    private $selectors = [
        "checkBox" => './/input[following-sibling::label[text()="%s"]]',
        "section" => './/fieldset[.//legend[text()="%s"]]'
    ];

    private function checkbox($name)
    {
        return sprintf($this->selectors["checkBox"], $name);
    }

    private function section($name)
    {
        return sprintf($this->selectors["section"], $name);
    }

    public function toggleCheckbox($name)
    {
        $this->xpath($this->checkbox($name))->click();
    }

    public function isSectionDisplayed($name)
    {
        $element = $this->xpath($this->section($name));
        return $element !== null && $element->isVisible();
    }
}
