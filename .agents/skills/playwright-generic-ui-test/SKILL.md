---
name: playwright-generic-ui-test
description: Validate browser-visible UI and UX changes with Playwright for Laravel Blade, Vite, or similar local web apps. Use after changes to auth pages, forms, navigation, responsive layout, validation states, interactive behavior, or any feature that should be checked in a browser.
---

# Playwright Generic UI Test

Use only when the task changes browser-visible UI.

## Workflow

1. Identify the page or route to test.
2. Start the local app if needed.
3. Use Playwright/browser checks for desktop and mobile widths.
4. Verify visible content, main interactions, form validation, and console errors.
5. Capture screenshots only when useful for debugging or review.

## Checks

- No obvious overlap or clipped text.
- Forms can be filled and submitted.
- Error and success states render.
- Responsive layout remains usable.
- Console has no unexpected errors.

## Closure

Report the tested URL, viewport(s), and any remaining risk.
