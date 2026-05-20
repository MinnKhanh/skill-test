# Local Skills For This Repo

This directory contains only reusable agent workflows that are worth loading for this Laravel 12 project. Keep `AGENTS.md` as the durable project context; keep skills as short task checklists.

## Core API Flow

Use these for most backend/API work:

1. `api-task-execution` - endpoint implementation flow.
2. `api-error-logging` - API errors, error codes, and safe logging.
3. `api-test-verify-gate` - tests, format, contract checks, and closure.

## Domain Skills

- `auth-feature-implementation` - auth, guards, Sanctum, login/logout/profile/password.
- `database-standard` - migrations, models, relationships, factories, seeders.
- `file-upload-security-standard` - upload validation, image processing, storage metadata.
- `feature-email-standard` - transactional email and queue reliability.
- `external-integration-resilience-standard` - third-party APIs, zipcode lookup, webhooks.
- `docs-guideline` - docs, API notes, Scramble-facing contracts, QA notes.
- `playwright-generic-ui-test` - UI validation after Blade/Vite changes.
- `caveman` - concise output and brevity guidance for agent replies, summaries, and commit messages.

## OpenSpec Skills

Keep these only for proposal-driven work:

- `openspec-explore`
- `openspec-propose`
- `openspec-apply-change`
- `openspec-archive-change`

## Maintenance Rule

Do not add a new skill for a checklist that can fit in an existing skill. Add a skill only when it has a clear trigger, repeated use, and project-specific knowledge that would otherwise be rediscovered.
