---
name: database-standard
description: Define and enforce Laravel database design and migration standards, including naming, indexing, constraints, and rollback safety. Use when creating or modifying schema, models, relationships, and data migrations.
---

# Database Standard

## Quick Rules

1. Use migrations for all schema changes; never ask for manual DB edits.
2. Use consistent naming:
   - Tables plural snake_case.
   - Foreign keys as `<table_singular>_id`.
   - Pivot tables alphabetical order.
3. Add proper constraints and indexes for query paths.
4. Keep migrations reversible and production-safe.
5. Prefer soft deletes only when business recovery/audit needs it.

## Migration Checklist

- [ ] Up/Down implemented and symmetric.
- [ ] Column types match domain data size.
- [ ] Nullable/defaults are intentional.
- [ ] FK constraints and onDelete behavior are explicit.
- [ ] Indexes exist for filter/sort/join fields.
- [ ] No destructive change without migration path.

## Model Rules

- Define `$fillable` or guarded strategy consistently.
- Add casts for typed attributes.
- Keep model thin: relations/scopes/constants only.
- Avoid multi-step business logic in model methods.

## Relationship Rules

- Eager load required relations to avoid N+1.
- Use query scopes for reusable filters.
- Validate referential integrity at both app and DB level when possible.

## Output Requirement

When applying this skill, always include:
1. Schema decision summary.
2. Migration impact/risk notes.
3. Rollback safety statement.
