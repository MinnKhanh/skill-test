---
name: api-testing-standard
description: Standardize Laravel API testing across feature, integration, and unit levels with guard-aware helpers and contract assertions. Use when implementing or refactoring API features.
---

# API Testing Standard

## Test Layers

1. Feature tests for endpoint behavior and contract.
2. Integration tests for DB + service flows.
3. Unit tests for complex pure business logic.

## Required Coverage

- Success path
- Validation failure
- Unauthorized/forbidden
- Not found
- Business conflict

## Rules

- Use factories/seeders for deterministic data.
- Add reusable helpers for guard- or actor-specific authentication setup.
- Assert JSON contract shape, not only status code.

## Checklist

- [ ] New behavior has test coverage.
- [ ] Existing behavior regression is protected.
- [ ] Error responses are asserted.
- [ ] Tests are deterministic and isolated.
