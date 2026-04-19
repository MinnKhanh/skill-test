---
name: multi-guard-authentication
description: Implement and enforce Laravel multi-guard authentication patterns across actor domains. Use when adding auth flows, securing routes, or handling guard-specific policies and tokens.
---

# Multi Guard Authentication

## Guard Strategy

1. Separate guards by actor domain (e.g., `web`, `api`, `customer`, `staff`).
2. Separate route groups and middleware per guard.
3. Never mix actor contexts in one auth flow.
4. Read identity from authenticated context, not client payload.

## Implementation Rules

- Define guard/provider in `config/auth.php`.
- Apply guard-specific middleware at route/controller level.
- Keep login/logout/reset logic separated by actor domain.
- Token naming/scopes must indicate guard ownership.

## Authorization Rules

- Use policy/gate/service checks for sensitive actions.
- Return 401 for unauthenticated, 403 for authenticated-but-forbidden.
- Avoid broad permissions in shared endpoints.

## Checklist

- [ ] Guard config is complete.
- [ ] Routes are isolated by guard.
- [ ] Controller uses correct guard context.
- [ ] Permission checks are explicit.
- [ ] Responses do not leak cross-guard data.
