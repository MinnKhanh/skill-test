---
name: api-exception-handling-standard
description: Standardize Laravel exception handling for API layers with proper HTTP mapping, safe messages, and structured logging. Use when adding business errors or refining global exception behavior.
---

# API Exception Handling Standard

## Rules

1. Use domain-specific exceptions for business failures.
2. Map exceptions to correct HTTP codes in global handler.
3. Return safe user-facing messages; log detailed internals.
4. Keep error response schema consistent with API contract.
5. Include request correlation context in logs when available.

## Exception Types

- Validation errors (422)
- Auth errors (401/403)
- Not found (404)
- Business rule conflicts (409/422 as designed)
- Unexpected server errors (500)

## Checklist

- [ ] Exception class intent is clear.
- [ ] Handler mapping is explicit and tested.
- [ ] No sensitive data exposed to clients.
- [ ] Logs include actionable troubleshooting context.
