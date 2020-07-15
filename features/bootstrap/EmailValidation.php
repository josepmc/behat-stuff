<?php

use Behat\Behat\Context\Context;
use Page\FormPage;
use Page\ResultPage;

class EmailValidation implements Context
{
    private $form;
    private $result;
    private string $uploadedFileName;

    public function __construct(FormPage $form, ResultPage $result)
    {
        $this->form = $form;
        $this->result = $result;
    }

    /**
     * @When /^I fill in the email field with '(.*)'$/
     */
    public function iFillInTheEmailField($email)
    {
        $this->form->inputEmail($email);
    }

    /**
     * @Then I submit the form
     */
    public function iSubmitTheForm()
    {
        $this->form->submit();
    }

    /**
     * @Then /^I should see a '(.*)'$/
     */
    public function iShouldSeeAResult($result)
    {
        if ($result === "The review page") {
            assert($this->result->present());
        } else {
            assert($this->form->submissionResult() === $result);
        }
    }

    /**
     * @Then I attach the test file
     */
    public function iAttachATestFile()
    {
        $file = (getenv("CI") !== false ? "/behat/features/bootstrap" : __DIR__) . "/Resources/Upload.jpg";
        $this->form->uploadFile($file);
        $this->uploadedFileName = basename($file);
    }

    /**
     * @Then I see the uploaded filename on the review page
     */
    public function iSeeTheUploadedFilename()
    {
        assert($this->uploadedFileName === $this->result->getPreview(), "Uploaded file name doesn't match with original name");
    }
}
