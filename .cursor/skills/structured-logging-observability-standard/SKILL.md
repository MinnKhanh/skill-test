---
name: structured-logging-observability-standard
description: Enforce structured logging and observability practices for Laravel APIs with correlation context and actionable alerts. Use when adding critical flows, debugging production issues, and improving auditability.
---

# Structured Logging Observability Standard

## Logging Rules

1. Log with consistent keys and context fields.
2. Include actor, endpoint, request id/correlation id when available.
3. Use proper log levels (`info`, `warning`, `error`).
4. Never log secrets, tokens, or raw sensitive payloads.

## Observability Rules

- Add alerts for critical failures.
- Ensure logs support root-cause analysis.
- Track key business events for audit trails.

## Checklist

- [ ] Critical actions are logged.
- [ ] Error logs are actionable.
- [ ] Sensitive data is redacted.
- [ ] Alert channel for severe incidents exists.
