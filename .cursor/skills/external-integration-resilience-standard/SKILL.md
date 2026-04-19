---
name: external-integration-resilience-standard
description: Improve resilience for external integrations in Laravel APIs with timeout, retry, fallback, and observability patterns. Use when calling third-party APIs, webhooks, storage, or messaging providers.
---

# External Integration Resilience Standard

## Core Rules

1. Set explicit timeout for all outbound calls.
2. Use retry with bounded attempts and backoff.
3. Classify failures: transient vs permanent.
4. Isolate third-party errors from core business flow where possible.
5. Log integration failures with correlation context.

## Reliability Patterns

- Circuit-break style protection for unstable providers.
- Queue async retries for non-blocking operations.
- Fallback behavior for optional integrations.

## Checklist

- [ ] Timeout and retry policy defined.
- [ ] Failure mode handling is explicit.
- [ ] Monitoring/alerting is in place.
- [ ] Business continuity for provider outage is considered.
