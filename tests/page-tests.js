const { spawn, execFileSync } = require("node:child_process");
const fs = require("node:fs");
const path = require("node:path");

const rootDir = path.resolve(__dirname, "..");
const reportPath = path.join(rootDir, "tests", "automation-test-report.md");
const phpExe = "C:\\xampp\\php\\php.exe";
const baseUrl = "http://127.0.0.1:8123";
const sessionDir = path.join(rootDir, "tests", ".php-session");

function sleep(ms) {
  return new Promise((resolve) => setTimeout(resolve, ms));
}

function normalizeText(value) {
  return value.replace(/\s+/g, " ").trim();
}

async function waitForServer(url, timeoutMs) {
  const start = Date.now();
  while (Date.now() - start < timeoutMs) {
    try {
      const response = await fetch(url, { redirect: "manual" });
      return response;
    } catch (error) {
      await sleep(250);
    }
  }
  throw new Error(`Timed out waiting for PHP server at ${url}`);
}

async function request(method, pathname, body) {
  const headers = {};
  let payload;

  if (body) {
    headers["Content-Type"] = "application/x-www-form-urlencoded";
    payload = new URLSearchParams(body).toString();
  }

  const response = await fetch(`${baseUrl}${pathname}`, {
    method,
    headers,
    body: payload,
    redirect: "manual",
  });

  const text = await response.text();
  return {
    status: response.status,
    headers: response.headers,
    body: text,
    normalizedBody: normalizeText(text),
  };
}

function expectIncludes(haystack, needle, message) {
  if (!haystack.includes(needle)) {
    throw new Error(message);
  }
}

async function main() {
  const timestamp = new Date().toISOString();
  const testUser = `user_${Date.now()}`;
  const testPassword = "pass123";
  const results = [];

  fs.mkdirSync(sessionDir, { recursive: true });

  const phpServer = spawn(
    phpExe,
    ["-d", `session.save_path=${sessionDir}`, "-S", "127.0.0.1:8123", "-t", rootDir],
    {
      cwd: rootDir,
      stdio: "ignore",
      windowsHide: true,
    }
  );

  const addResult = (id, page, title, status, details) => {
    results.push({ id, page, title, status, details });
  };

  try {
    await waitForServer(`${baseUrl}/Signin.php`, 10000);

    try {
      const response = await request("GET", "/Signin.php");
      if (response.status !== 200) {
        throw new Error(`Expected HTTP 200, received ${response.status}`);
      }
      expectIncludes(response.normalizedBody, "Sign in", "Signin heading not found");
      expectIncludes(response.normalizedBody, "Username", "Signin username field label not found");
      expectIncludes(response.normalizedBody, "Password", "Signin password field label not found");
      addResult("TC-001", "Signin.php", "Signin page loads", "PASS", `HTTP ${response.status} and expected login fields are visible.`);
    } catch (error) {
      addResult("TC-001", "Signin.php", "Signin page loads", "FAIL", error.message);
    }

    try {
      const response = await request("GET", "/signup.php");
      if (response.status !== 200) {
        throw new Error(`Expected HTTP 200, received ${response.status}`);
      }
      expectIncludes(response.normalizedBody, "Sign up", "Signup heading not found");
      expectIncludes(response.normalizedBody, "Signup", "Signup submit button not found");
      addResult("TC-002", "signup.php", "Signup page loads", "PASS", `HTTP ${response.status} and signup form text are visible.`);
    } catch (error) {
      addResult("TC-002", "signup.php", "Signup page loads", "FAIL", error.message);
    }

    try {
      const response = await request("GET", "/contactus.html");
      if (response.status !== 200) {
        throw new Error(`Expected HTTP 200, received ${response.status}`);
      }
      expectIncludes(response.normalizedBody, "Contact US", "Contact heading not found");
      expectIncludes(response.normalizedBody, "Send Message", "Contact form title not found");
      expectIncludes(response.normalizedBody, "SM Food Choice", "Branding text not found");
      addResult("TC-003", "contactus.html", "Contact page loads", "PASS", `HTTP ${response.status} and contact content are visible.`);
    } catch (error) {
      addResult("TC-003", "contactus.html", "Contact page loads", "FAIL", error.message);
    }

    try {
      const response = await request("POST", "/signup.php", {
        name: testUser,
        password: testPassword,
      });
      const location = response.headers.get("location") || "";
      if (response.status !== 302) {
        throw new Error(`Expected redirect after signup, received HTTP ${response.status}`);
      }
      if (!location.endsWith("/Signin.php") && location !== "Signin.php") {
        throw new Error(`Expected redirect to Signin.php, received "${location}"`);
      }
      addResult("TC-004", "signup.php", "Valid signup redirects to signin", "PASS", `HTTP ${response.status} redirect to ${location}.`);
    } catch (error) {
      addResult("TC-004", "signup.php", "Valid signup redirects to signin", "FAIL", error.message);
    }

    try {
      const response = await request("POST", "/signup.php", {
        name: "12345",
        password: "abc123",
      });
      if (response.status !== 200) {
        throw new Error(`Expected HTTP 200 with validation message, received ${response.status}`);
      }
      expectIncludes(response.normalizedBody, "Please enter valid information", "Signup validation alert not found");
      addResult("TC-005", "signup.php", "Numeric username is rejected", "PASS", "Validation alert is shown for invalid signup input.");
    } catch (error) {
      addResult("TC-005", "signup.php", "Numeric username is rejected", "FAIL", error.message);
    }

    try {
      const response = await request("POST", "/Signin.php", {
        name: testUser,
        password: testPassword,
      });
      const location = response.headers.get("location") || "";
      if (response.status !== 302) {
        throw new Error(`Expected redirect after signin, received HTTP ${response.status}`);
      }
      if (!location.endsWith("/Home.php") && location !== "Home.php") {
        throw new Error(`Expected redirect to Home.php, received "${location}"`);
      }
      addResult("TC-006", "Signin.php", "Valid signin redirects to home", "PASS", `HTTP ${response.status} redirect to ${location}.`);
    } catch (error) {
      addResult("TC-006", "Signin.php", "Valid signin redirects to home", "FAIL", error.message);
    }

    try {
      const response = await request("POST", "/Signin.php", {
        name: "wrong_user",
        password: "wrong_pass",
      });
      if (response.status !== 200) {
        throw new Error(`Expected HTTP 200 with validation alert, received ${response.status}`);
      }
      expectIncludes(response.normalizedBody, "Invalid email or password", "Signin error alert not found");
      addResult("TC-007", "Signin.php", "Invalid signin shows error", "PASS", "Invalid-credential alert is shown.");
    } catch (error) {
      addResult("TC-007", "Signin.php", "Invalid signin shows error", "FAIL", error.message);
    }

    try {
      const response = await request("GET", "/Home.php");
      if (response.status !== 200) {
        throw new Error(`Expected HTTP 200, received ${response.status}`);
      }
      expectIncludes(response.normalizedBody, "MENU", "Menu heading not found");
      expectIncludes(response.normalizedBody, "Order Now", "Order call-to-action not found");
      expectIncludes(response.normalizedBody, "Contact Us", "Contact navigation link not found");
      addResult("TC-008", "Home.php", "Home page loads", "PASS", `HTTP ${response.status} and key home-page content are visible.`);
    } catch (error) {
      addResult("TC-008", "Home.php", "Home page loads", "FAIL", error.message);
    }

    try {
      const response = await request("GET", "/Home.php");
      if (response.status !== 200) {
        throw new Error(`Expected HTTP 200, received ${response.status}`);
      }
      expectIncludes(response.normalizedBody, "Spring Rolls", "Seeded starter item not found");
      expectIncludes(response.normalizedBody, "Veg Noodles", "Seeded Chinese item not found");
      expectIncludes(response.normalizedBody, "Cold Coffee", "Seeded beverage item not found");
      addResult("TC-009", "Home.php", "Dynamic menu items render", "PASS", "Seeded database menu items appear on the home page.");
    } catch (error) {
      addResult("TC-009", "Home.php", "Dynamic menu items render", "FAIL", error.message);
    }

    try {
      const response = await request("GET", "/contactus.html");
      if (response.status !== 200) {
        throw new Error(`Expected HTTP 200, received ${response.status}`);
      }
      expectIncludes(response.normalizedBody, "Full name", "Contact full-name input label not found");
      expectIncludes(response.normalizedBody, "Email", "Contact email input label not found");
      expectIncludes(response.normalizedBody, "Type Here...", "Contact message input label not found");
      addResult("TC-010", "contactus.html", "Contact form fields are visible", "PASS", "The contact form input prompts are present.");
    } catch (error) {
      addResult("TC-010", "contactus.html", "Contact form fields are visible", "FAIL", error.message);
    }
  } finally {
    phpServer.kill();
  }

  const passed = results.filter((result) => result.status === "PASS").length;
  const failed = results.filter((result) => result.status === "FAIL").length;

  const lines = [
    "# Automation Test Report - SM Food Choice",
    "",
    `- Executed At: ${timestamp}`,
    `- Base URL: ${baseUrl}`,
    `- Total Test Cases: ${results.length}`,
    `- Passed: ${passed}`,
    `- Failed: ${failed}`,
    "",
    "| Test Case | Page | Scenario | Status | Details |",
    "|---|---|---|---|---|",
    ...results.map((result) => {
      const details = result.details.replace(/\|/g, "\\|");
      return `| ${result.id} | ${result.page} | ${result.title} | ${result.status} | ${details} |`;
    }),
    "",
    "## Summary",
    failed === 0
      ? "All automated page-level tests passed."
      : `${failed} automated test case(s) failed. Review the table above for the exact defect signals.`,
    "",
    "## Test Data Used",
    `- Existing login user: \`existing_user / existing_pass\``,
    `- Fresh signup user created during run: \`${testUser} / ${testPassword}\``,
    `- Seeded menu items: \`Spring Rolls\`, \`Veg Noodles\`, \`Cold Coffee\``,
  ];

  fs.writeFileSync(reportPath, `${lines.join("\n")}\n`, "utf8");
  console.log(`Report written to ${reportPath}`);

  if (failed > 0) {
    process.exitCode = 1;
  }
}

main().catch((error) => {
  console.error(error.message);
  process.exitCode = 1;
});
