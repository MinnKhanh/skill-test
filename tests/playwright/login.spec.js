import { test, expect } from '@playwright/test';

const baseUrl = process.env.PLAYWRIGHT_BASE_URL ?? 'http://127.0.0.1:8001';

test.describe('Login Feature', () => {
  test('shows the login page', async ({ page }) => {
    await page.goto(`${baseUrl}/login`);

    await expect(page).toHaveTitle(/Sign In/);
    await expect(page.getByRole('heading', { name: 'Welcome Back 👋' })).toBeVisible();
    await expect(page.getByText('App thống kê data')).toBeVisible();
    await expect(page.getByLabel('Email')).toBeVisible();
    await expect(page.getByLabel('Password')).toBeVisible();
    await expect(page.getByRole('button', { name: /^Sign in$/ })).toBeVisible();
  });

  test('toggles password visibility', async ({ page }) => {
    await page.goto(`${baseUrl}/login`);

    await expect(page.locator('#password')).toHaveAttribute('type', 'password');
    await page.getByRole('button', { name: 'Show password' }).click();
    await expect(page.locator('#password')).toHaveAttribute('type', 'text');
    await page.getByRole('button', { name: 'Hide password' }).click();
    await expect(page.locator('#password')).toHaveAttribute('type', 'password');
  });

  test('shows loading state on submit', async ({ page }) => {
    await page.goto(`${baseUrl}/login`);
    await page.getByLabel('Email').fill('test@example.com');
    await page.getByLabel('Password').fill('password');

    await page.evaluate(() => {
      document.getElementById('loginForm').addEventListener('submit', (event) => {
        event.preventDefault();
      });
    });

    await page.getByRole('button', { name: /^Sign in$/ }).click();
    await expect(page.locator('#btnText')).toContainText('Signing in...');
    await expect(page.locator('#loader')).toBeVisible();
  });

  test('handles responsive layout without horizontal overflow', async ({ page }) => {
    const viewports = [
      { width: 375, height: 667 },
      { width: 768, height: 1024 },
      { width: 1280, height: 800 },
    ];

    for (const viewport of viewports) {
      await page.setViewportSize(viewport);
      await page.goto(`${baseUrl}/login`);
      await expect(page.locator('form#loginForm')).toBeVisible();

      const isOverflowing = await page.evaluate(() => (
        document.documentElement.scrollWidth > document.documentElement.clientWidth
      ));

      expect(isOverflowing).toBe(false);
    }
  });
});
