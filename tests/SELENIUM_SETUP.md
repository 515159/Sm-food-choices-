# Selenium Setup

This project now includes Selenium browser automation using Microsoft Edge in headless mode.

## Install

```powershell
npm.cmd install
```

## Run

Start XAMPP MySQL first, seed the test data, and start the PHP server:

```powershell
C:\xampp\php\php.exe tests\seed-fixtures.php
C:\xampp\php\php.exe -d session.save_path=tests\.php-session -S 127.0.0.1:8123 -t .
```

Then run:

```powershell
npm.cmd run test:selenium
```

## Output

The Selenium report is written to:

`tests/selenium-test-report.md`

## Covered Cases

- Signin page renders
- Signup page renders
- Valid signup
- Invalid signup
- Valid signin
- Invalid signin
- Home page menu/CTA render
- Dynamic food items render
- Contact page render
- Contact-to-signup navigation
