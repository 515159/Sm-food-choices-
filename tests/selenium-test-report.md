# Selenium Test Report - SM Food Choice

- Executed At: 2026-04-19T12:09:19.650Z
- Base URL: http://127.0.0.1:8123
- Browser: Microsoft Edge (visible)
- Total Test Cases: 15
- Passed: 15
- Failed: 0

| Test Case | Page | Scenario | Status | Details | Screenshot |
|---|---|---|---|---|---|
| TC-001 | signup.php | Signup Valid | PASS | Valid signup opened the signin form using sel_user_1776600414697. | [TC-001_Signup_Valid_PASS.png](C:/xampp/htdocs/smfood/tests/selenium-screenshots/TC-001_Signup_Valid_PASS.png) |
| TC-002 | signup.php | Signup Empty Username | PASS | Signup username field has required validation for empty input. | [TC-002_Signup_Empty_Username_PASS.png](C:/xampp/htdocs/smfood/tests/selenium-screenshots/TC-002_Signup_Empty_Username_PASS.png) |
| TC-003 | signup.php | Signup Numeric Username | PASS | Validation alert displayed: Please enter valid information | [TC-003_Signup_Numeric_Username_PASS.png](C:/xampp/htdocs/smfood/tests/selenium-screenshots/TC-003_Signup_Numeric_Username_PASS.png) |
| TC-004 | Signin.php | Signin Valid | PASS | Valid login redirected to Home.php. | [TC-004_Signin_Valid_PASS.png](C:/xampp/htdocs/smfood/tests/selenium-screenshots/TC-004_Signin_Valid_PASS.png) |
| TC-005 | Signin.php | Signin Invalid Password | PASS | Validation alert displayed: Invalid email or password | [TC-005_Signin_Invalid_Password_PASS.png](C:/xampp/htdocs/smfood/tests/selenium-screenshots/TC-005_Signin_Invalid_Password_PASS.png) |
| TC-006 | Signin.php | Signin Empty Fields | PASS | Signin username and password fields both have required validation. | [TC-006_Signin_Empty_Fields_PASS.png](C:/xampp/htdocs/smfood/tests/selenium-screenshots/TC-006_Signin_Empty_Fields_PASS.png) |
| TC-007 | Home.php | Home Load | PASS | Home page loaded successfully with menu and CTA. | [TC-007_Home_Load_PASS.png](C:/xampp/htdocs/smfood/tests/selenium-screenshots/TC-007_Home_Load_PASS.png) |
| TC-008 | Home.php | Menu Navigation | PASS | Navbar Menu link scrolled to the menu section. | [TC-008_Menu_Navigation_PASS.png](C:/xampp/htdocs/smfood/tests/selenium-screenshots/TC-008_Menu_Navigation_PASS.png) |
| TC-009 | Home.php | Reviews Navigation | PASS | Navbar Reviews link navigated to the reviews section. | [TC-009_Reviews_Navigation_PASS.png](C:/xampp/htdocs/smfood/tests/selenium-screenshots/TC-009_Reviews_Navigation_PASS.png) |
| TC-010 | Home.php | Reviews Images | PASS | Reviews section rendered 3 review images. | [TC-010_Reviews_Images_PASS.png](C:/xampp/htdocs/smfood/tests/selenium-screenshots/TC-010_Reviews_Images_PASS.png) |
| TC-011 | Home.php | Cart Count | PASS | Cart count increased to 1 after adding one item. | [TC-011_Cart_Count_PASS.png](C:/xampp/htdocs/smfood/tests/selenium-screenshots/TC-011_Cart_Count_PASS.png) |
| TC-012 | Home.php | Cart Modal | PASS | Cart modal opened with cart and address fields visible. | [TC-012_Cart_Modal_PASS.png](C:/xampp/htdocs/smfood/tests/selenium-screenshots/TC-012_Cart_Modal_PASS.png) |
| TC-013 | contactus.html | Contact Page | PASS | Contact page loaded with the message form. | [TC-013_Contact_Page_PASS.png](C:/xampp/htdocs/smfood/tests/selenium-screenshots/TC-013_Contact_Page_PASS.png) |
| TC-014 | Home.php | DB Connection OK | PASS | Database connection is OK and seeded menu items are visible across all menu categories. | [TC-014_DB_Connection_OK_PASS.png](C:/xampp/htdocs/smfood/tests/selenium-screenshots/TC-014_DB_Connection_OK_PASS.png) |
| TC-015 | tests/db-down-sim.php | DB Down Error | PASS | DB-down negative test showed the expected connection failure message. | [TC-015_DB_Down_Error_PASS.png](C:/xampp/htdocs/smfood/tests/selenium-screenshots/TC-015_DB_Down_Error_PASS.png) |

## Test Data Used
- Selenium-created login user: `sel_user_1776600414697 / pass123`
- Seeded menu items: `Spring Rolls`, `Veg Noodles`, `Cold Coffee`
- DB down test page: `tests/db-down-sim.php`
