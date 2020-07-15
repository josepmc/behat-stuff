Feature: Upload files
    Scenario: Display filename on confirmation page
        Given I visit the test page
        And I check the favorite food option
        When I attach the test file
        Given I fill in the email field with 'valid@email.com'
        And I submit the form
        Then I see the uploaded filename on the review page
