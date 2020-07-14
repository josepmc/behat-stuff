Feature: Email is validated and required
    Background:
        Given I visit the test page

    Scenario Outline: Confirm email validation
        Given I fill in the email field with '<email value>'
        When I submit the form
        Then I should see a '<submission result>'

        Examples:
            | email value     | submission result                                 |
            #|                 | A validation message that email is required |
            |                 | This field is required.                           |
            #| steve@          | A validation email that email must be valid |
            | steve@          | This does not appear to be a valid email address. |
            | valid@email.com | The review page                                   |
