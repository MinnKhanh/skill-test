---
name: form-request-standard
description: Standardize Laravel FormRequest validation and authorization patterns for API endpoints. Use when creating or updating request validation rules, messages, and input normalization.
---

# Form Request Standard

## Core Rules

1. Every write endpoint must use FormRequest.
2. Use `authorize()` explicitly; do not leave permission implicit.
3. Keep validation in FormRequest, not controller/service.
4. Use custom rules for reusable domain constraints.
5. Normalize input in `prepareForValidation()` when needed.

## Validation Design

- Validate type + business constraints.
- Use `exists`/`unique` with proper scopes.
- Add min/max/regex only when backed by business rule.
- For update flows, handle ignore-self logic safely.

## Error Message Rules

- Use localization keys for messages.
- Keep messages user-facing and actionable.
- Avoid leaking internal IDs or schema details.

## Checklist

- [ ] Request class name is endpoint-intent clear.
- [ ] `authorize()` is correct.
- [ ] `rules()` covers all writable fields.
- [ ] Nested arrays validated safely.
- [ ] Edge cases handled (null, empty, type mismatch).
