# Instructions

- Following Playwright test failed.
- Explain why, be concise, respect Playwright best practices.
- Provide a snippet of code with the fix, if possible.

# Test info

- Name: login.spec.js >> Login Feature >> shows loading state on submit
- Location: tests\playwright\login.spec.js:27:3

# Error details

```
Error: locator.fill: Error: strict mode violation: getByLabel('Password') resolved to 2 elements:
    1) <input required="" id="password" maxlength="32" name="password" type="password" aria-describedby="" autocomplete="current-password" placeholder="At least 8 characters" class="block h-10 w-full rounded-lg border  border-[#d9e2ec]  bg-[#f8fbfd] px-3 pr-14 text-xs font-medium text-[#263142] shadow-sm placeholder-[#9aa8b7] transition focus:border-[#153342] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#153342]/10"/> aka getByRole('textbox', { name: 'Password' })
    2) <button type="button" id="togglePassword" aria-label="Show password" class="absolute inset-y-0 right-0 flex items-center px-3 text-xs font-bold text-[#64748b] hover:text-[#153342] focus:outline-none focus:ring-2 focus:ring-[#153342]/10">↵                Show↵            </button> aka getByRole('button', { name: 'Show password' })

Call log:
  - waiting for getByLabel('Password')

```

# Page snapshot

```yaml
- main [ref=e3]:
  - generic [ref=e5]:
    - paragraph [ref=e6]: App thống kê data
    - generic [ref=e7]:
      - heading "Welcome Back 👋" [level=1] [ref=e8]
      - paragraph [ref=e9]: Today is a new day. It is your day. You shape it. Sign in to start managing your projects.
    - generic [ref=e10]:
      - generic [ref=e11]:
        - generic [ref=e12]: Email
        - textbox "Email" [active] [ref=e14]:
          - /placeholder: Example@email.com
          - text: test@example.com
      - generic [ref=e15]:
        - generic [ref=e16]: Password
        - generic [ref=e17]:
          - textbox "Password" [ref=e18]:
            - /placeholder: At least 8 characters
          - button "Show password" [ref=e19]: Show
      - generic [ref=e20]:
        - generic [ref=e21]:
          - checkbox "Remember me" [ref=e22]
          - generic [ref=e23]: Remember me
        - link "Forgot Password?" [ref=e25] [cursor=pointer]:
          - /url: http://127.0.0.1:8001/forgot-password
      - button "Sign in" [ref=e27]:
        - generic [ref=e28]: Sign in
      - generic [ref=e31]: Or
      - link "G Sign in with Google" [ref=e34] [cursor=pointer]:
        - /url: http://127.0.0.1:8001/auth/google/redirect
        - generic [ref=e35]: G
        - generic [ref=e36]: Sign in with Google
      - paragraph [ref=e37]:
        - text: Do not you have an account?
        - link "Sign up" [ref=e38] [cursor=pointer]:
          - /url: http://127.0.0.1:8001/register
    - paragraph [ref=e39]: © 2023 All Rights Reserved
  - region "Login visual" [ref=e40]
```

# Test source

```ts
  1  | import { test, expect } from '@playwright/test';
  2  | 
  3  | const baseUrl = process.env.PLAYWRIGHT_BASE_URL ?? 'http://127.0.0.1:8001';
  4  | 
  5  | test.describe('Login Feature', () => {
  6  |   test('shows the login page', async ({ page }) => {
  7  |     await page.goto(`${baseUrl}/login`);
  8  | 
  9  |     await expect(page).toHaveTitle(/Sign In/);
  10 |     await expect(page.getByRole('heading', { name: 'Welcome Back 👋' })).toBeVisible();
  11 |     await expect(page.getByText('App thống kê data')).toBeVisible();
  12 |     await expect(page.getByLabel('Email')).toBeVisible();
  13 |     await expect(page.getByLabel('Password')).toBeVisible();
  14 |     await expect(page.getByRole('button', { name: /^Sign in$/ })).toBeVisible();
  15 |   });
  16 | 
  17 |   test('toggles password visibility', async ({ page }) => {
  18 |     await page.goto(`${baseUrl}/login`);
  19 | 
  20 |     await expect(page.locator('#password')).toHaveAttribute('type', 'password');
  21 |     await page.getByRole('button', { name: 'Show password' }).click();
  22 |     await expect(page.locator('#password')).toHaveAttribute('type', 'text');
  23 |     await page.getByRole('button', { name: 'Hide password' }).click();
  24 |     await expect(page.locator('#password')).toHaveAttribute('type', 'password');
  25 |   });
  26 | 
  27 |   test('shows loading state on submit', async ({ page }) => {
  28 |     await page.goto(`${baseUrl}/login`);
  29 |     await page.getByLabel('Email').fill('test@example.com');
> 30 |     await page.getByLabel('Password').fill('password');
     |                                       ^ Error: locator.fill: Error: strict mode violation: getByLabel('Password') resolved to 2 elements:
  31 | 
  32 |     await page.evaluate(() => {
  33 |       document.getElementById('loginForm').addEventListener('submit', (event) => {
  34 |         event.preventDefault();
  35 |       });
  36 |     });
  37 | 
  38 |     await page.getByRole('button', { name: /^Sign in$/ }).click();
  39 |     await expect(page.locator('#btnText')).toContainText('Signing in...');
  40 |     await expect(page.locator('#loader')).toBeVisible();
  41 |   });
  42 | 
  43 |   test('handles responsive layout without horizontal overflow', async ({ page }) => {
  44 |     const viewports = [
  45 |       { width: 375, height: 667 },
  46 |       { width: 768, height: 1024 },
  47 |       { width: 1280, height: 800 },
  48 |     ];
  49 | 
  50 |     for (const viewport of viewports) {
  51 |       await page.setViewportSize(viewport);
  52 |       await page.goto(`${baseUrl}/login`);
  53 |       await expect(page.locator('form#loginForm')).toBeVisible();
  54 | 
  55 |       const isOverflowing = await page.evaluate(() => (
  56 |         document.documentElement.scrollWidth > document.documentElement.clientWidth
  57 |       ));
  58 | 
  59 |       expect(isOverflowing).toBe(false);
  60 |     }
  61 |   });
  62 | });
  63 | 
```