---
name: docs-guideline
description: Write, update, or review technical documentation for a Laravel project. Use for workflow docs, implementation plans, API notes, setup instructions, environment variables, Scramble-facing contracts, changelogs, delivery notes, QA/UAT checklists, and handoff documents for other agents or developers.
---

# Docs Guideline

Use when behavior, API contracts, setup, or delivery notes change.

## Rules

1. Document runtime truth, not plans, unless the document is explicitly a proposal/spec.
2. Keep docs concise and action-oriented.
3. Mention actor/guard, endpoint, request shape, response shape, and important business rules for API docs.
4. Update docs when API response contract, validation, status codes, or auth behavior changes.
5. Keep examples small and consistent with `ResponseHelper`.

## Locations

- `docs/` for module and feature documentation.
- `AGENTS.md` for durable project operating context.
- `.agents/skills/` for reusable agent workflows only.
- `openspec/` for proposal-driven changes.

## Checklist

- [ ] Runtime behavior is accurate.
- [ ] No stale removed-skill path references.
- [ ] Endpoint docs match routes and resources.
- [ ] Known limitations or manual QA notes are included when needed.
