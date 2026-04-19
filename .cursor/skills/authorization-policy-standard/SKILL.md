---
name: authorization-policy-standard
description: Implement Laravel authorization via policies and gates for guard-aware and ownership-aware access control. Use when endpoints require fine-grained permissions beyond authentication middleware.
---

# Authorization Policy Standard

## Core Rules

1. Authentication is not authorization; always check permission for protected actions.
2. Use Policy for model-based checks and Gate for non-model checks.
3. Keep guard behavior explicit for each actor domain.
4. Separate ownership rules from role rules.

## Implementation Guidance

- Register policies in auth provider.
- Use `authorize()` in controllers/services where appropriate.
- Return 403 for forbidden actions.
- Avoid duplicated permission logic across controllers.

## Checklist

- [ ] Permission matrix is clear by actor type.
- [ ] Policy methods cover CRUD and custom actions.
- [ ] Ownership checks are enforced.
- [ ] Unauthorized access paths are tested.
