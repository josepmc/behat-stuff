<?php

namespace Page;

use Behat\Mink\Element\NodeElement;
use Behat\Testwork\Call\Exception\FatalThrowableError;
use Exception;

trait SharedPage
{
    /**
     * Returns the first XPath matching the parameter, null in case it doesn't exist
     * 
     * @param xpath The XPath to search for
     */
    public function xpath(String $xpath): NodeElement
    {
        $element = $this->getSession()->getPage()->findAll('xpath', $xpath);
        $numEls = $element === null ? 0 : sizeof($element);
        if ($numEls === 0) {
            return null;
        } elseif ($numEls > 1) {
            printf("Warning: The XPath %s yielded %d results", $xpath, $numEls);
        }
        return $element[0];
    }

    /**
     * Returns the alert message if an alert is present, null otherwise
     */
    public function getAlertMessage(): ?string
    {
        try {
            return $this->getSession()->getDriver()->getWebDriverSession()->getAlert_text();
        } catch (Exception $err) {
            return null;
        }
    }

    /**
     * Returns whether an alert is displayed
     */
    public function isAlertPresent(): bool
    {
        return $this->getAlertMessage() !== null;
    }

    /**
     * Dismisses the alert using the "Ok" button
     */
    public function dismissAlert()
    {
        return $this->getSession()->getDriver()->getWebDriverSession()->accept_alert();
    }
}
