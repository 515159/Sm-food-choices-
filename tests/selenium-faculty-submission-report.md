# Final Testing Report - SM Food Choice

## 1. Project Information
- Project Name: SM Food Choice
- Date: 19 April 2026
- Build Version: v1.0
- Application URL: `http://localhost/SMFoodChoice/Signin.php`

## 2. Testing Objective
Validate the core student-project flows for signup, signin, home page rendering, section navigation, cart interaction, contact page access, and database connectivity.

## 3. Testing Tools Used
- Selenium IDE checklist for faculty/demo execution
- Selenium WebDriver automation already present in the project
- Browser used in the recorded environment: Microsoft Edge 147.0.3912.72
- Environment: XAMPP Apache + MySQL

## 4. Test Environment
- OS: Windows
- Web Server: Apache via XAMPP
- Database: MySQL
- Project Path: `C:\xampp\htdocs\smfood`
- Driver in recorded environment: `C:\xampp\htdocs\smfood\drivers\msedgedriver\msedgedriver.exe`

## 5. Scope
### In Scope
- Signup validation
- Signin validation
- Home page load
- Menu and reviews navigation
- Cart badge and cart modal
- Contact page navigation
- Database available and database-down behavior

### Out of Scope
- Payment processing
- Performance or load testing
- Security hardening
- Admin workflow

## 6. Test Case Summary
- Total Test Cases: 15
- Passed: 14
- Failed: 1
- Blocked: 0
- Not Run: 0

## 7. Detailed Result Summary
| Test Case | Module | Title | Status | Screenshot |
|---|---|---|---|---|
| TC-001 | Signup | Signup with valid username and password | Pass | `TC-001_Signup_Valid_PASS.png` |
| TC-002 | Signup | Signup with empty username | Pass | `TC-002_Signup_Empty_Username_PASS.png` |
| TC-003 | Signup | Signup with numeric-only username | Pass | `TC-003_Signup_Numeric_Username_PASS.png` |
| TC-004 | Signin | Signin with valid credentials | Pass | `TC-004_Signin_Valid_PASS.png` |
| TC-005 | Signin | Signin with invalid password | Pass | `TC-005_Signin_Invalid_Password_PASS.png` |
| TC-006 | Signin | Signin with empty fields | Pass | `TC-006_Signin_Empty_Fields_PASS.png` |
| TC-007 | Home | Home page loads successfully | Pass | `TC-007_Home_Load_PASS.png` |
| TC-008 | Menu | Menu section navigation from navbar | Pass | `TC-008_Menu_Navigation_PASS.png` |
| TC-009 | Reviews | Reviews section navigation from navbar | Pass | `TC-009_Reviews_Navigation_PASS.png` |
| TC-010 | Reviews | Review images display | Pass | `TC-010_Reviews_Images_PASS.png` |
| TC-011 | Cart | Add item to cart updates count | Pass | `TC-011_Cart_Count_PASS.png` |
| TC-012 | Cart | Cart modal opens | Pass | `TC-012_Cart_Modal_PASS.png` |
| TC-013 | Contact | Open contact page | Pass | `TC-013_Contact_Page_PASS.png` |
| TC-014 | Database | Database connection success path | Pass | `TC-014_DB_Connection_OK_PASS.png` |
| TC-015 | Database | Database down error handling | Fail | `TC-015_DB_Down_Error_PASS.png` |

## 8. Defect / Observation Summary
| ID | Title | Severity | Priority | Status |
|---|---|---|---|---|
| BUG-001 | Database-down case shows a fatal connection error instead of a graceful custom error message | Major | Medium | Open |

## 9. Evidence Checklist
- Selenium execution environment note: [selenium-environment.txt reference captured in screenshot]
- Automated run report: [selenium-test-report.md](/C:/xampp/htdocs/smfood/tests/selenium-test-report.md)
- Screenshot folder: [selenium-screenshots](/C:/xampp/htdocs/smfood/tests/selenium-screenshots)
- Test case sheet source: [Test_Cases_SM_Food_Choice (1).csv](/C:/xampp/htdocs/smfood/Test_Cases_SM_Food_Choice%20(1).csv)

## 10. Risks and Observations
- Core navigation and cart demo flows are working in the captured run.
- The database-down negative scenario still exposes a raw fatal error, so error handling is not user-friendly.
- There is a mismatch between one environment note showing `15 passed, 0 failed` and the test case sheet showing `TC-015` as `Fail`. For faculty submission, the detailed case sheet should be treated as the authoritative result unless the case is rerun and recaptured.

## 11. Conclusion
The application is stable for basic demo use across signup, signin, navigation, reviews, cart, and contact-page flows. The main functional gap is the database-failure scenario, where the application does not yet fail gracefully.

## 12. Sign-Off
- Tested By: `<sm food>`
- Reviewed By: `<faculty / guide name>`
- Date: `19 April 2026`
