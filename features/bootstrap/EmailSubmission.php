<?php

use Behat\Behat\Context\Context;
use Page\FormPage;
use Page\ResultPage;
use Helper\Mail;

class EmailSubmission implements Context
{
    private $form;
    private $result;
    private $mail;
    private string $tempMail;
    private int $emailCount = 0;

    public function __construct(FormPage $form, ResultPage $result)
    {
        $this->form = $form;
        $this->result = $result;
        $this->mail = new Mail();
    }

    /**
     * @When I register a temporary email address at https://www.guerrillamail.com
     */
    public function iRegisterTemporaryEmail()
    {
        $this->tempMail = $this->mail->getEmail();
    }

    /**
     * @Then I fill in my email temporary email address
     */
    public function iFillTemporaryEmail()
    {
        $this->form->inputEmail($this->tempMail);
    }

    /**
     * @Then I submit the form fully
     */
    public function iSubmitTheFormFully()
    {
        $this->form->submit();
        $this->result->submit();
    }

    /**
     * @Then I should receive a confirmation email in my temporary email inbox
     */
    public function iShouldReceiveEmail()
    {
        while (($newMail = $this->mail->getNewMail()) && $newMail->count === $this->emailCount) {
            sleep(5);
        }
        assert($_ENV['EMAIL_SENDER'] !== null, "Define EMAIL_SENDER as an environment variable");
        $filtered = array_filter($newMail->list, function ($mail) {
            return $mail->mail_from === $_ENV['EMAIL_SENDER'];
        });
        assert(sizeof($filtered) === 1, "Verification email wasn't found");
    }
}
