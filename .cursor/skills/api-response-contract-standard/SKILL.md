---
name: api-response-contract-standard
description: Enforce consistent Laravel API response contracts for success, errors, and pagination metadata. Use when building or modifying JSON endpoints, resources, and list responses.
---

# API Response Contract Standard

## Core Contract

Use one envelope format across all endpoints:
- `status_code`
- `message`
- `errors`
- `data`

## Rules

1. Keep field names stable across all API domains and actor contexts.
2. Use `data` object/array consistently by endpoint type.
3. For list endpoints, include pagination meta in predictable structure.
4. Never leak internal exception traces in response.
5. Preserve backward compatibility unless versioning is approved.

## Checklist

- [ ] Success response matches contract.
- [ ] Validation/business errors match contract.
- [ ] Pagination format is consistent.
- [ ] Messages are localization-ready.
