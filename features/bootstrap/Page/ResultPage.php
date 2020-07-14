<?php

namespace Page;

use SensioLabs\Behat\PageObjectExtension\PageObject\Page;

class ResultPage extends Page
{
    use SharedPage;
    private $selectors = [
        "self" => './/*[@class="reviewResponse"]',
    ];

    /**
     * Whether the page is present
     */
    public function present(): bool
    {
        return $this->xpath($this->selectors['self']) !== null;
    }
}
