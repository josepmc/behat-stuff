Feature: Email confirmation sent on form submission
    Scenario: Register using a temporary email address
        Given I register a temporary email address at https://www.guerrillamail.com
        And I visit the test page
        And I fill in my email temporary email address
        When I submit the form fully
        Then I should receive a confirmation email in my temporary email inbox