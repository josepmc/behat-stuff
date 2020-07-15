<?php

namespace Page;

use SensioLabs\Behat\PageObjectExtension\PageObject\Page;

class ResultPage extends Page
{
    use SharedPage;
    private $selectors = [
        "self" => './/*[@class="reviewResponse"]',
        "submit" => './/input[@type="submit"]',
        "formSubmitted" => './/*[@class="wFormThankYou"]',
        "uploadedImage" => './/*[contains(@class, "response") and contains(@class, "typefileupload")]',
        "uploadedAttachment" => './/span[.//*[contains(@class, "fa-file")]]'
    ];

    /**
     * Whether the page is present
     */
    public function present(): bool
    {
        return $this->xpath($this->selectors['self']) !== null;
    }

    /**
     * Returns the *first* filename of the previously uploaded file
     * TLDR; Would be better to get the uploaded file and compare locally using imagemagick or similar
     */
    public function getPreview()
    {
        $attachedImage = $this->xpath($this->selectors['uploadedImage'])->getText();
        $attachedFile = $this->xpath($this->selectors['uploadedAttachment'])->getText();
        assert(strpos($attachedFile, $attachedImage) !== false, "The file name differs! $attachedFile <> $attachedImage");
        return $attachedImage;
    }

    /**
     * Submits the form and waits for the results page to be visible
     */
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
