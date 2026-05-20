---
name: feature-email-standard
description: Implement, refactor, or review Laravel email and notification behavior. Use for transactional emails, password reset mail, account registration mail, admin/user notifications, Mailables, Notifications, templates, localization, queue dispatch, retry behavior, audit logging, and delivery failure handling.
---

# Feature Email Standard

Use when adding or changing emails.

## Rules

1. Use Mailables/Notifications instead of ad hoc mail calls.
2. Queue emails when delivery should not block the API response.
3. Dispatch after commit when email depends on committed database state.
4. Keep templates localized when user-facing language varies.
5. Do not include secrets or raw tokens in logs.
6. Log enough context to diagnose failed delivery.

## Queue Reliability

- Jobs should be idempotent where possible.
- Set retry/backoff/timeout when custom jobs are used.
- Keep payloads small and serializable.

## Checklist

- [ ] Template content and subject are reviewed.
- [ ] Recipient source is trusted.
- [ ] Queue or sync delivery choice is explicit.
- [ ] Failure path is observable.
