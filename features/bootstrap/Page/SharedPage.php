<?php

namespace Page;

trait SharedPage
{
    public function xpath($xpath)
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
}
