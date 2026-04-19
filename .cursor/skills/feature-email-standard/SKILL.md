---
name: feature-email-standard
description: Implement transactional email features in Laravel with consistent templates, queue strategy, error handling, and auditability. Use when adding account, notification, and workflow emails.
---

# Feature Email Standard

## Core Rules

1. Use Mailable classes; avoid inline raw mail in controllers.
2. Keep email content templates separated in `resources/views/email`.
3. Queue non-blocking emails by default.
4. Ensure recipient selection follows business rules explicitly.
5. Avoid sending duplicate emails in retry scenarios.

## Template Rules

- Subject must be explicit and localized where needed.
- Keep placeholders named clearly.
- Do not include sensitive secrets in body.
- Include fallback copy for missing optional data.

## Reliability Rules

- Dispatch after DB commit for transaction-dependent data.
- Log send attempts/failures with correlation context.
- Define retry policy for queued mail jobs.

## Checklist

- [ ] Mailable class created/updated.
- [ ] Template variables validated.
- [ ] Queue behavior defined.
- [ ] Failure handling/logging present.
- [ ] QA scenario includes content and recipient checks.
