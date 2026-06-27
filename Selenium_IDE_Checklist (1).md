# Selenium IDE Checklist (SM Food Choice)

## 1. Install
1. Install Selenium IDE extension in Chrome.
2. Open extension and create project: SM Food Choice Testing.
3. Base URL: http://localhost/SMFoodChoice/

## 2. Recommended Test Suites
- Suite 1: Authentication
- Suite 2: Navigation and UI
- Suite 3: Cart Basic Flow

## 3. Suggested Automated Test Cases

### Test: Valid Signin
- open | /Signin.php
- type | name=name | testuser
- type | name=password | testpass
- click | css=input[type='submit']
- assertLocation | **/Home.php*
- captureEntirePageScreenshot | TC-SEL-001_ValidSignin.png

### Test: Invalid Signin
- open | /Signin.php
- type | name=name | testuser
- type | name=password | wrongpass
- click | css=input[type='submit']
- captureEntirePageScreenshot | TC-SEL-002_InvalidSignin.png

### Test: Home To Reviews Navigation
- open | /Home.php
- click | linkText=Hygiene
- pause | 1000
- captureEntirePageScreenshot | TC-SEL-003_ReviewsScroll.png

### Test: Contact Us Navigation
- open | /Home.php
- click | linkText=Contact Us
- assertLocation | **/contactus.html*
- captureEntirePageScreenshot | TC-SEL-004_ContactPage.png

## 4. Execution Evidence To Capture
1. Selenium IDE test list before run.
2. Run All summary (pass/fail count).
3. Individual failing test error panel.
4. Corresponding browser page screenshot.

## 5. Faculty Submission Tip
Include 1 screenshot for each pass case and each fail case, plus one final run summary screenshot.
