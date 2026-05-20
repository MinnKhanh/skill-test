---
name: api-error-logging
description: Standardize Laravel error handling, business error codes, exception mapping, and safe structured logging. Use for API or web backend failures, validation failures, business rule failures, auth/security failures, external integration errors, critical logs, and any change that affects what users see or what operators debug.
---

# API Error And Logging

Use this skill for API failure paths. Keep the response envelope consistent with `ResponseHelper`.

## Error Rules

1. Separate expected business failures from unexpected system failures.
2. Map errors to correct HTTP status codes: `401`, `403`, `404`, `422`, `500`.
3. Return safe user-facing messages.
4. Do not expose stack traces, SQL, tokens, passwords, or secrets.
5. Use stable `error_code` values when the frontend needs deterministic handling.

## Error Code Format

Use:

`{DOMAIN}_{ACTION}_{REASON}`

Examples:

- `USER_DELETE_HAS_REQUESTS`
- `SERVICE_UPDATE_INVALID_STATUS`
- `AUTH_LOGIN_INVALID_CREDENTIALS`

## Logging Context

For important failures, include sanitized context:

- `actor_type`: `admin`, `user`, or `system`
- `actor_id`
- `domain`
- `action`
- request or entity identifiers
- sanitized input subset
- exception class/message for server-side logs

Never log raw passwords, raw tokens, reset tokens, secret keys, or full uploaded file contents.

## Checklist

- [ ] HTTP status matches the failure.
- [ ] Error message is safe and useful.
- [ ] `error_code` is stable when clients need it.
- [ ] Logs contain enough context without sensitive data.
