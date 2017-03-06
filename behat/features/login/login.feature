# features/search.feature
Feature: Login

  @javascript
  Scenario Outline: Login
    Given I am on "/login"
    When I fill in "username" with "<email>"
    And I fill in "password" with "<password>"
    And I submit form "form#form-login"
    Then I should see "<message>"
    Examples:
      | email              | password | message       |
      | vanlk@younetco.com | 123456   | Invalid login |
      | vanlk@younetco.com | 1234567  | Invalid login |
      |                    |          | Invalid login |
      |                    |          | Invalid login |
      | sadad@dsad.adsad   | 123456   | Invalid login |