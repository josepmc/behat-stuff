<?php

namespace Page;

use SensioLabs\Behat\PageObjectExtension\PageObject\Page;

class ResultPage extends Page
{
    use SharedPage;
    private $selectors = [
        "self" => './/*[@class="reviewResponse"]',
        "submit" => './/input[@type="submit"]',
        "formSubmitted" => './/*[@class="wFormThankYou"]'
    ];

    /**
     * Whether the page is present
     */
    public function present(): bool
    {
        return $this->xpath($this->selectors['self']) !== null;
    }

    public function submit()
    {
        $this->waitFor(20000, function () {
            return $this->present();
        });
        $this->xpath($this->selectors['submit'])->click();
        $this->waitFor(20000, function () {
            return $this->xpath($this->selectors['formSubmitted']) !== null;
        });
    }
}
