---
name: api-feature-implement
description: Implement API features in Laravel using a consistent flow from route to validation, service logic, response contract, and tests. Use when building new endpoints or extending existing API behavior.
---

# API Feature Implement

## Default Workflow

1. Confirm business requirement and acceptance criteria.
2. Define/adjust route and auth middleware.
3. Create or update FormRequest validation.
4. Implement service logic (transaction if needed).
5. Return standardized API response.
6. Add/adjust tests and verification notes.

## Design Rules

- Keep controller thin and deterministic.
- Use service layer for business logic.
- Reuse existing enums/constants/config keys.
- Preserve existing response contract unless versioned change.
- Add clear error handling for known failure paths.

## Output Requirement

When finishing an implementation, provide:
1. Files changed.
2. Behavior change summary.
3. Validation and error handling notes.
4. Verification steps (automated/manual).

## Checklist

- [ ] Endpoint secured correctly.
- [ ] Validation complete.
- [ ] Business rules implemented.
- [ ] Response format compliant.
- [ ] Test or manual verification included.
