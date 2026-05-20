---
name: external-integration-resilience-standard
description: Implement, refactor, secure, or review Laravel integrations with external systems. Use for third-party APIs, reCAPTCHA verification, zipcode lookup, webhooks, mail/storage/payment providers, HTTP clients, timeouts, retries, fallbacks, provider error mapping, config/env secrets, and integration logging.
---

# External Integration Resilience Standard

Use when code calls systems outside the app.

## Rules

1. Put base URLs, keys, timeouts, and feature flags in config/env.
2. Set explicit timeouts for every network call.
3. Retry only safe, retryable failures.
4. Validate and normalize external responses before using them.
5. Log provider, operation, latency, status, and sanitized identifiers.
6. Do not log secrets, tokens, or full PII payloads.
7. Define fallback behavior for provider downtime.

## Checklist

- [ ] Config exists with safe defaults.
- [ ] Timeout and retry policy are explicit.
- [ ] Provider errors map to safe API errors.
- [ ] Logs are actionable.
- [ ] Tests mock the provider boundary.
