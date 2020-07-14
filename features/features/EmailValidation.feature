Feature: Email is validated and required
    Background:
        Given I visit the test page

    Scenario Outline: Confirm email validation
        Given I fill in "email" with: "<email_value>"
        When I submit the form
        Then I should see a "<submission result>"

        Examples:

            | <email_value>   | <submission result>                         |
            |                 | A validation message that email is required |
            | steve@          | A validation email that email must be valid |
            | valid@email.com | The review page                             |
