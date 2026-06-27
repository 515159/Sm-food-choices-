# Jira Bug Template (SM Food Choice)

Use this template for each failed test case.

## Issue Type
Bug

## Summary
[Module] Short bug title

Example: [Signin] Valid user cannot login

## Description
Observed during testing of SM Food Choice.

## Environment
- OS: Windows
- Browser: Chrome (version)
- URL: http://localhost/SMFoodChoice/Signin.php
- Build/Commit: Classroom project build

## Preconditions
- Apache running
- MySQL running on port 3307
- Database: register

## Steps To Reproduce
1. Open URL
2. Enter values: <username>, <password>
3. Click LOGIN

## Expected Result
User should be redirected to Home.php.

## Actual Result
User stays on Signin page and sees invalid login alert.

## Severity
- Critical: system crash/data loss
- Major: key function blocked
- Minor: small UI issue

## Priority
High / Medium / Low

## Test Case Reference
TC-XXX

## Attachments
- Screenshot(s): TC-XXX_issue.png
- Optional video

## Labels
testing, sm-food-choice, faculty-demo

## Assignee
<name>

## Status Flow
To Do -> In Progress -> Done
