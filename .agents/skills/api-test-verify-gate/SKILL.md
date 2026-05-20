---
name: api-test-verify-gate
description: Verify Laravel backend, API, auth, database, upload, integration, and UI-adjacent tasks before closure. Use after coding changes to choose tests, run format/lint, check response or UI contracts, validate security-sensitive flows, and report residual risk.
---

# API Test And Verify Gate

Use this before closing any Laravel coding task that changes behavior.

## Minimum Verification Matrix

Cover the cases that apply to the changed behavior:

1. Success path.
2. Invalid input: `422`.
3. Unauthorized or forbidden: `401` / `403`.
4. Not found: `404`.
5. Business rule failure: usually `422` unless existing code uses another status.

## Test Choice

- Feature tests for endpoints and JSON contract.
- Service/unit tests for complex branching, calculations, or pure business rules.
- Manual verification only when automated tests are not practical; explain why.

## Commands

Prefer project commands:

- `composer test`
- `php artisan code:format --check`
- `php artisan code:format`

For a narrow change, run the smallest relevant test first, then broader tests when risk is higher.

## Closure Checklist

- [ ] Behavior matches the user request.
- [ ] API envelope remains `message`, `errors`, `data`.
- [ ] No unapproved breaking change.
- [ ] Format/lint/test result is reported.
- [ ] Remaining risk or skipped verification is stated plainly.
