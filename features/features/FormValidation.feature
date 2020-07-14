Feature: Conditional sections should display when trigger is selected
    Scenario: Hide conditional sections when done
        Given I visit the test page
        When I check the favorite food option
        Then I should see the favorite food section
        When I uncheck the favorite food option
        Then I should not see the favorite food section