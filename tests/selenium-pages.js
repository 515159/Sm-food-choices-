const { Builder, By, Key, until } = require("selenium-webdriver");
const edge = require("selenium-webdriver/edge");
const fs = require("node:fs");
const path = require("node:path");
const net = require("node:net");

const rootDir = path.resolve(__dirname, "..");
const reportPath = path.join(rootDir, "tests", "selenium-test-report.md");
const screenshotDir = path.join(rootDir, "tests", "selenium-screenshots");
const baseUrl = "http://127.0.0.1:8123";
const edgeDriverPath = path.join(rootDir, "drivers", "msedgedriver", "msedgedriver.exe");
const edgeProfileDir = path.join(rootDir, "tests", ".edge-profile");
const headless = process.env.SELENIUM_HEADLESS === "true";

function sleep(ms) {
  return new Promise((resolve) => setTimeout(resolve, ms));
}

function normalizeText(value) {
  return value.replace(/\s+/g, " ").trim();
}

function slugify(value) {
  return value.replace(/[^a-zA-Z0-9]+/g, "_").replace(/^_+|_+$/g, "");
}

function cleanDir(dirPath) {
  fs.mkdirSync(dirPath, { recursive: true });
  for (const entry of fs.readdirSync(dirPath)) {
    fs.rmSync(path.join(dirPath, entry), { force: true, recursive: true });
  }
}

function isPortOpen(host, port) {
  return new Promise((resolve) => {
    const socket = new net.Socket();
    socket.setTimeout(1000);
    socket.once("connect", () => {
      socket.destroy();
      resolve(true);
    });
    const fail = () => {
      socket.destroy();
      resolve(false);
    };
    socket.once("error", fail);
    socket.once("timeout", fail);
    socket.connect(port, host);
  });
}

async function waitForHttp(url, timeoutMs) {
  const start = Date.now();
  while (Date.now() - start < timeoutMs) {
    try {
      const response = await fetch(url, { redirect: "manual" });
      if (response.status >= 200) {
        return;
      }
    } catch (error) {
      await sleep(300);
    }
  }
  throw new Error(`Timed out waiting for ${url}`);
}

async function acceptAlertIfPresent(driver) {
  try {
    const alert = await driver.switchTo().alert();
    await alert.accept();
  } catch (error) {
    return;
  }
}

async function resetToFreshPage(driver, page = "/Signin.php") {
  await acceptAlertIfPresent(driver);
  await driver.get(`${baseUrl}${page}`);
}

async function saveScreenshot(driver, testId, title, status) {
  await acceptAlertIfPresent(driver);
  const fileName = `${testId}_${slugify(title)}_${status}.png`;
  const fullPath = path.join(screenshotDir, fileName);
  const image = await driver.takeScreenshot();
  fs.writeFileSync(fullPath, image, "base64");
  return fullPath;
}

async function runCase(driver, results, id, page, title, fn) {
  let status = "PASS";
  let details = "";

  try {
    details = await fn();
  } catch (error) {
    status = "FAIL";
    details = error && error.message ? error.message : String(error);
  }

  const screenshotPath = await saveScreenshot(driver, id, title, status);
  results.push({ id, page, title, status, details, screenshotPath });
}

async function clearAndType(element, value) {
  await element.sendKeys(Key.chord(Key.CONTROL, "a"), Key.BACK_SPACE);
  if (value) {
    await element.sendKeys(value);
  }
}

async function clickVisiblePlusButton(driver) {
  const buttons = await driver.findElements(
    By.css(".dynamic-menu-section .menuBtn.plus, .legacy-menu-section .menuBtn.plus")
  );

  for (const button of buttons) {
    if (await button.isDisplayed()) {
      await driver.executeScript("arguments[0].scrollIntoView({block:'center'});", button);
      await driver.sleep(400);
      await driver.executeScript("arguments[0].click();", button);
      return;
    }
  }

  throw new Error("No visible add-to-cart button was found.");
}

async function main() {
  if (!(await isPortOpen("127.0.0.1", 3306))) {
    throw new Error("MySQL is not running on port 3306. Start XAMPP MySQL first.");
  }

  cleanDir(screenshotDir);
  fs.mkdirSync(edgeProfileDir, { recursive: true });

  const options = new edge.Options();
  const args = [
    "--disable-gpu",
    "--disable-dev-shm-usage",
    "--no-first-run",
    "--no-default-browser-check",
    "--remote-debugging-port=0",
    `--user-data-dir=${edgeProfileDir}`,
    "--window-size=1440,1400",
  ];
  if (headless) {
    args.unshift("--headless=new");
  }
  options.addArguments(...args);
  options.setBinaryPath("C:\\Program Files (x86)\\Microsoft\\Edge\\Application\\msedge.exe");

  if (!fs.existsSync(edgeDriverPath)) {
    throw new Error(`Edge WebDriver not found at ${edgeDriverPath}`);
  }

  const service = new edge.ServiceBuilder(edgeDriverPath);
  const driver = await new Builder()
    .forBrowser("MicrosoftEdge")
    .setEdgeService(service)
    .setEdgeOptions(options)
    .build();

  const testUser = `sel_user_${Date.now()}`;
  const testPassword = "pass123";
  const results = [];

  try {
    await waitForHttp(`${baseUrl}/Signin.php`, 10000);
    await driver.manage().window().setRect({ width: 1440, height: 1400, x: 0, y: 0 });

    await runCase(driver, results, "TC-001", "signup.php", "Signup Valid", async () => {
      await resetToFreshPage(driver, "/signup.php");
      const nameField = await driver.findElement(By.name("name"));
      const passwordField = await driver.findElement(By.name("password"));
      await clearAndType(nameField, testUser);
      await clearAndType(passwordField, testPassword);
      await driver.findElement(By.css("input[type='submit']")).click();
      await driver.wait(until.elementLocated(By.css("form[action='Signin.php']")), 15000);
      const heading = normalizeText(await driver.findElement(By.css("h2")).getText());
      if (!heading.includes("Sign in")) {
        throw new Error("Signup did not land on the signin form.");
      }
      return `Valid signup opened the signin form using ${testUser}.`;
    });

    await runCase(driver, results, "TC-002", "signup.php", "Signup Empty Username", async () => {
      await resetToFreshPage(driver, "/signup.php");
      const required = await driver.findElement(By.name("name")).getAttribute("required");
      if (!required) {
        throw new Error("Username field is missing required validation.");
      }
      return "Signup username field has required validation for empty input.";
    });

    await runCase(driver, results, "TC-003", "signup.php", "Signup Numeric Username", async () => {
      await resetToFreshPage(driver, "/signup.php");
      await clearAndType(await driver.findElement(By.name("name")), "12345");
      await clearAndType(await driver.findElement(By.name("password")), "abc123");
      await driver.findElement(By.css("input[type='submit']")).click();
      const alert = await driver.wait(until.alertIsPresent(), 5000);
      const text = await alert.getText();
      if (!text.includes("Please enter valid information")) {
        throw new Error(`Unexpected alert: ${text}`);
      }
      return `Validation alert displayed: ${text}`;
    });

    await runCase(driver, results, "TC-004", "Signin.php", "Signin Valid", async () => {
      await resetToFreshPage(driver, "/Signin.php");
      await clearAndType(await driver.findElement(By.name("name")), testUser);
      await clearAndType(await driver.findElement(By.name("password")), testPassword);
      await driver.findElement(By.css("input[type='submit']")).click();
      await driver.wait(until.urlContains("/Home.php"), 20000);
      return "Valid login redirected to Home.php.";
    });

    await runCase(driver, results, "TC-005", "Signin.php", "Signin Invalid Password", async () => {
      await resetToFreshPage(driver, "/Signin.php");
      await clearAndType(await driver.findElement(By.name("name")), testUser);
      await clearAndType(await driver.findElement(By.name("password")), "wrong_pass");
      await driver.findElement(By.css("input[type='submit']")).click();
      const alert = await driver.wait(until.alertIsPresent(), 5000);
      const text = await alert.getText();
      if (!text.includes("Invalid email or password")) {
        throw new Error(`Unexpected alert: ${text}`);
      }
      return `Validation alert displayed: ${text}`;
    });

    await runCase(driver, results, "TC-006", "Signin.php", "Signin Empty Fields", async () => {
      await resetToFreshPage(driver, "/Signin.php");
      const nameRequired = await driver.findElement(By.name("name")).getAttribute("required");
      const passwordRequired = await driver.findElement(By.name("password")).getAttribute("required");
      if (!nameRequired || !passwordRequired) {
        throw new Error("Signin required validation is missing.");
      }
      return "Signin username and password fields both have required validation.";
    });

    await runCase(driver, results, "TC-007", "Home.php", "Home Load", async () => {
      await resetToFreshPage(driver, "/Home.php");
      await driver.wait(until.elementLocated(By.id("categorySection")), 10000);
      const bodyText = normalizeText(await driver.findElement(By.tagName("body")).getText());
      if (!bodyText.includes("MENU") || !bodyText.includes("Order Now")) {
        throw new Error("Home page did not load menu and CTA content.");
      }
      return "Home page loaded successfully with menu and CTA.";
    });

    await runCase(driver, results, "TC-008", "Home.php", "Menu Navigation", async () => {
      await resetToFreshPage(driver, "/Home.php");
      await driver.findElement(By.css("a[href='#categorySection']")).click();
      await driver.sleep(1200);
      const menuTop = await driver.executeScript("return document.getElementById('categorySection').getBoundingClientRect().top;");
      if (Math.abs(Number(menuTop)) > 200) {
        throw new Error(`Menu section did not scroll into view. Top offset: ${menuTop}`);
      }
      return "Navbar Menu link scrolled to the menu section.";
    });

    await runCase(driver, results, "TC-009", "Home.php", "Reviews Navigation", async () => {
      await resetToFreshPage(driver, "/Home.php");
      await driver.findElement(By.css("a[href='#reviewsSection']")).click();
      await driver.sleep(1200);
      const reviewsTitle = normalizeText(await driver.findElement(By.css("#reviewsSection .hygiene-title")).getText());
      if (!reviewsTitle.includes("REVIEWS")) {
        throw new Error("Reviews section title not visible after navigation.");
      }
      return "Navbar Reviews link navigated to the reviews section.";
    });

    await runCase(driver, results, "TC-010", "Home.php", "Reviews Images", async () => {
      await resetToFreshPage(driver, "/Home.php");
      await driver.executeScript("document.querySelector('#reviewsSection').scrollIntoView({behavior:'instant', block:'start'});");
      await driver.sleep(800);
      const images = await driver.findElements(By.css("#reviewsSection img.rounded-circle"));
      if (images.length < 3) {
        throw new Error(`Expected at least 3 review images, found ${images.length}`);
      }
      return `Reviews section rendered ${images.length} review images.`;
    });

    await runCase(driver, results, "TC-011", "Home.php", "Cart Count", async () => {
      await resetToFreshPage(driver, "/Home.php");
      await driver.executeScript("document.getElementById('categorySection').scrollIntoView({block:'start'});");
      await driver.sleep(800);
      await clickVisiblePlusButton(driver);
      await driver.sleep(800);
      const countText = normalizeText(await driver.findElement(By.css(".shoppingCartAfter")).getText());
      if (countText !== "1") {
        throw new Error(`Expected cart count 1, found ${countText}`);
      }
      return "Cart count increased to 1 after adding one item.";
    });

    await runCase(driver, results, "TC-012", "Home.php", "Cart Modal", async () => {
      await resetToFreshPage(driver, "/Home.php");
      await driver.executeScript("document.getElementById('categorySection').scrollIntoView({block:'start'});");
      await driver.sleep(800);
      await clickVisiblePlusButton(driver);
      await driver.sleep(600);
      await driver.executeScript("arguments[0].click();", await driver.findElement(By.css(".shoppingCart")));
      await driver.wait(until.elementLocated(By.css("#exampleModal.show")), 10000);
      const modalText = normalizeText(await driver.findElement(By.css("#exampleModal .modal-body")).getText());
      if (!modalText.includes("Select Menu") || !modalText.includes("Address")) {
        throw new Error("Cart modal did not show expected content.");
      }
      return "Cart modal opened with cart and address fields visible.";
    });

    await runCase(driver, results, "TC-013", "contactus.html", "Contact Page", async () => {
      await resetToFreshPage(driver, "/contactus.html");
      await driver.wait(until.elementLocated(By.css(".contactForm form")), 10000);
      const bodyText = normalizeText(await driver.findElement(By.tagName("body")).getText());
      if (!bodyText.includes("Contact US") || !bodyText.includes("Send Message")) {
        throw new Error("Contact page content is incomplete.");
      }
      return "Contact page loaded with the message form.";
    });

    await runCase(driver, results, "TC-014", "Home.php", "DB Connection OK", async () => {
      await resetToFreshPage(driver, "/Home.php");
      const startersText = normalizeText(await driver.findElement(By.tagName("body")).getText());
      if (!startersText.includes("Spring Rolls")) {
        throw new Error("Missing DB item: Spring Rolls");
      }
      await driver.findElement(By.css(".product-box-layout4.chinese")).click();
      await driver.sleep(1000);
      const chineseText = normalizeText(await driver.findElement(By.css(".dynamic-menu-section[data-category-key='chinese']")).getText());
      if (!chineseText.includes("Veg Noodles")) {
        throw new Error("Missing DB item: Veg Noodles");
      }
      await driver.findElement(By.css(".product-box-layout4.beverages")).click();
      await driver.sleep(1000);
      const beveragesText = normalizeText(await driver.findElement(By.css(".dynamic-menu-section[data-category-key='beverages']")).getText());
      if (!beveragesText.includes("Cold Coffee")) {
        throw new Error("Missing DB item: Cold Coffee");
      }
      return "Database connection is OK and seeded menu items are visible across all menu categories.";
    });

    await runCase(driver, results, "TC-015", "tests/db-down-sim.php", "DB Down Error", async () => {
      await resetToFreshPage(driver, "/tests/db-down-sim.php");
      const bodyText = normalizeText(await driver.findElement(By.tagName("body")).getText());
      if (!bodyText.includes("Connection failed")) {
        throw new Error("Expected DB-down connection error message was not shown.");
      }
      return "DB-down negative test showed the expected connection failure message.";
    });
  } finally {
    await driver.quit().catch(() => {});
  }

  const passed = results.filter((result) => result.status === "PASS").length;
  const failed = results.length - passed;
  const lines = [
    "# Selenium Test Report - SM Food Choice",
    "",
    `- Executed At: ${new Date().toISOString()}`,
    `- Base URL: ${baseUrl}`,
    `- Browser: Microsoft Edge (${headless ? "headless" : "visible"})`,
    `- Total Test Cases: ${results.length}`,
    `- Passed: ${passed}`,
    `- Failed: ${failed}`,
    "",
    "| Test Case | Page | Scenario | Status | Details | Screenshot |",
    "|---|---|---|---|---|---|",
    ...results.map((result) => {
      const details = result.details.replace(/\|/g, "\\|");
      return `| ${result.id} | ${result.page} | ${result.title} | ${result.status} | ${details} | [${path.basename(result.screenshotPath)}](${result.screenshotPath.replace(/\\/g, "/")}) |`;
    }),
    "",
    "## Test Data Used",
    `- Selenium-created login user: \`${testUser} / ${testPassword}\``,
    "- Seeded menu items: `Spring Rolls`, `Veg Noodles`, `Cold Coffee`",
    "- DB down test page: `tests/db-down-sim.php`",
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
