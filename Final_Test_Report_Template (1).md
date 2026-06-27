# Final Testing Report - SM Food Choice

## 1. Project Information
- Project Name: SM Food Choice
- Team/Student: <your name>
- Date: <date>
- Build Version: v1.0

## 2. Testing Objective
Validate core functionality of authentication, navigation, menu/cart interactions, review display, contact page, and database connectivity.

## 3. Testing Tools Used
- Selenium IDE (automation)
- Jira (bug tracking)
- Browser: Chrome
- Environment: XAMPP (Apache + MySQL)

## 4. Test Environment
- OS: Windows
- Server: Apache (XAMPP)
- Database: MySQL on localhost:3307
- DB Name: register
- Application URL: http://localhost/SMFoodChoice/Signin.php

## 5. Scope
In Scope:
- Signup, Signin
- Home page load
- Navbar navigation (Menu, Reviews, Contact)
- Basic cart interaction
- Review images rendering

Out of Scope:
- Payment gateway integration
- Performance and load testing

## 6. Test Case Summary
- Total Test Cases: 15
- Passed: <count>
- Failed: <count>
- Blocked: <count>
- Not Run: <count>

## 7. Defect Summary (From Jira)
| Bug ID | Title | Severity | Priority | Status |
|---|---|---|---|---|
| BUG-001 | <title> | Major | High | Done |
| BUG-002 | <title> | Minor | Medium | To Do |

## 8. Screenshot Evidence
Add screenshots below with captions:

1. TC-001 Signup Valid - pass
2. TC-004 Signin Valid - pass
3. TC-005 Signin Invalid - fail/pass as observed
4. TC-009 Reviews navigation
5. TC-010 Reviews images visible
6. Selenium Run Summary
7. Jira Bug Issue page screenshot

## 9. Risks and Observations
- Example: Password is stored as plain text in signup table.
- Example: No role-based admin flow in current cleaned build.

## 10. Conclusion
The application is <stable/partially stable> for demo usage. Core flows are <working/not working> based on executed tests and attached evidence.

## 11. Sign-Off
- Tested By: <name>
- Reviewed By: <faculty/guide name>
- Date: <date>
