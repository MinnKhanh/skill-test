---
name: database-standard
description: Design, change, review, or troubleshoot Laravel persistence. Use for migrations, schema changes, columns, indexes, foreign keys, unique constraints, Eloquent models, relationships, casts, fillable/hidden fields, factories, seeders, query performance, soft deletes, and deployment-safe data changes.
---

# Database Standard

Use when adding or modifying persistence.

## Migration Rules

1. All schema changes go through migrations.
2. Name tables, columns, indexes, and foreign keys consistently with the existing schema.
3. Add indexes for frequent filters, joins, status fields, and lookup keys.
4. Use nullable/default values deliberately.
5. Keep production migrations backward-compatible when possible.
6. Do not drop or rename columns in the same release that code still reads.

## Model Rules

- Prefer Eloquent relationships and scopes for reusable queries.
- Add `$fillable` only for intended write fields.
- Hide sensitive fields.
- New models should normally include Factory and Seeder support for tests and local data.

## Safety Checklist

- [ ] Rollback path is clear.
- [ ] Existing data migration risk is considered.
- [ ] Unique constraints match business rules.
- [ ] Soft delete impact is considered where relevant.
- [ ] Tests or seed data are updated when needed.
