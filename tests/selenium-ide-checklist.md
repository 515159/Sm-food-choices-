# Selenium IDE Checklist - SM Food Choice

## 1. Selenium IDE Setup
1. Install the Selenium IDE extension in Google Chrome.
2. Open Selenium IDE and create a new project named `SM Food Choice Testing`.
3. Set the Base URL to `http://localhost/SMFoodChoice/`.
4. Create these suites:
- `Authentication`
- `Navigation and UI`
- `Cart Basic Flow`

## 2. Suggested Selenium IDE Test Cases

### TC-SEL-001 Valid Signin
| Command | Target | Value |
|---|---|---|
| `open` | `/Signin.php` |  |
| `type` | `name=name` | `testuser` |
| `type` | `name=password` | `testpass` |
| `click` | `css=input[type='submit']` |  |
| `assertLocation` | `**/Home.php*` |  |
| `captureEntirePageScreenshot` | `TC-SEL-001_ValidSignin.png` |  |

### TC-SEL-002 Invalid Signin
| Command | Target | Value |
|---|---|---|
| `open` | `/Signin.php` |  |
| `type` | `name=name` | `testuser` |
| `type` | `name=password` | `wrongpass` |
| `click` | `css=input[type='submit']` |  |
| `captureEntirePageScreenshot` | `TC-SEL-002_InvalidSignin.png` |  |

### TC-SEL-003 Home To Reviews Navigation
| Command | Target | Value |
|---|---|---|
| `open` | `/Home.php` |  |
| `click` | `linkText=Hygiene` |  |
| `pause` | `1000` |  |
| `captureEntirePageScreenshot` | `TC-SEL-003_ReviewsScroll.png` |  |

### TC-SEL-004 Contact Us Navigation
| Command | Target | Value |
|---|---|---|
| `open` | `/Home.php` |  |
| `click` | `linkText=Contact Us` |  |
| `assertLocation` | `**/contactus.html*` |  |
| `captureEntirePageScreenshot` | `TC-SEL-004_ContactPage.png` |  |

## 3. Evidence To Capture
1. Selenium IDE project window showing the test list before execution.
2. `Run all` result summary showing pass and fail counts.
3. The Selenium IDE error panel for any failing test.
4. The browser page screenshot that matches each executed case.

## 4. Submission Package
- Include one screenshot for each passing case.
- Include one screenshot for each failing case, if any fail during the Selenium IDE run.
- Include one final run summary screenshot.
- Attach the completed test case sheet and final report together with the screenshots.

## 5. Notes For This Project
- Local application path used in the existing project documentation: `http://localhost/SMFoodChoice/`
- Existing automated browser report in this repository: [selenium-test-report.md](/C:/xampp/htdocs/smfood/tests/selenium-test-report.md)
- Existing screenshots folder: [selenium-screenshots](/C:/xampp/htdocs/smfood/tests/selenium-screenshots)
