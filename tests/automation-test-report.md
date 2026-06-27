# Automation Test Report - SM Food Choice

- Executed At: 2026-04-19T11:39:12.066Z
- Base URL: http://127.0.0.1:8123
- Total Test Cases: 10
- Passed: 10
- Failed: 0

| Test Case | Page | Scenario | Status | Details |
|---|---|---|---|---|
| TC-001 | Signin.php | Signin page loads | PASS | HTTP 200 and expected login fields are visible. |
| TC-002 | signup.php | Signup page loads | PASS | HTTP 200 and signup form text are visible. |
| TC-003 | contactus.html | Contact page loads | PASS | HTTP 200 and contact content are visible. |
| TC-004 | signup.php | Valid signup redirects to signin | PASS | HTTP 302 redirect to Signin.php. |
| TC-005 | signup.php | Numeric username is rejected | PASS | Validation alert is shown for invalid signup input. |
| TC-006 | Signin.php | Valid signin redirects to home | PASS | HTTP 302 redirect to Home.php. |
| TC-007 | Signin.php | Invalid signin shows error | PASS | Invalid-credential alert is shown. |
| TC-008 | Home.php | Home page loads | PASS | HTTP 200 and key home-page content are visible. |
| TC-009 | Home.php | Dynamic menu items render | PASS | Seeded database menu items appear on the home page. |
| TC-010 | contactus.html | Contact form fields are visible | PASS | The contact form input prompts are present. |

## Summary
All automated page-level tests passed.

## Test Data Used
- Existing login user: `existing_user / existing_pass`
- Fresh signup user created during run: `user_1776598752067 / pass123`
- Seeded menu items: `Spring Rolls`, `Veg Noodles`, `Cold Coffee`
