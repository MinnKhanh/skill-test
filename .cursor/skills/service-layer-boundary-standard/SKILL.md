---
name: service-layer-boundary-standard
description: Enforce clean boundaries between controllers, services, and data access in Laravel APIs. Use when implementing complex business features and preventing controller/service bloat.
---

# Service Layer Boundary Standard

## Boundary Rules

1. Controller orchestrates, Service executes business logic.
2. Service returns clear outputs; avoid implicit global state usage.
3. Data access stays in model/repository patterns, not scattered.
4. Validation belongs to FormRequest or dedicated validators.
5. Keep cross-service dependencies explicit and minimal.

## Design Guidance

- Break long service methods into cohesive private steps.
- Use DTO-like structures when parameter lists grow complex.
- Keep side effects isolated and predictable.

## Checklist

- [ ] Controller remains thin.
- [ ] Service responsibility is single-purpose.
- [ ] Business logic is not duplicated.
- [ ] Method contracts are easy to test.
