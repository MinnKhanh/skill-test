---
name: queue-job-reliability-standard
description: Improve Laravel queue and job reliability with retries, idempotency, timeout control, and failure handling. Use when implementing async workflows like email, notifications, and external sync tasks.
---

# Queue Job Reliability Standard

## Core Rules

1. Jobs must be idempotent where possible.
2. Set explicit `tries`, `backoff`, and `timeout`.
3. Use `afterCommit` dispatch for transaction-dependent jobs.
4. Capture and monitor failed jobs.
5. Keep payloads minimal and serializable.

## Failure Handling

- Distinguish retryable vs non-retryable failures.
- Add structured logging with job context.
- Provide operational guidance for replay/recovery.

## Checklist

- [ ] Retry policy is defined.
- [ ] Duplicate side effects are prevented.
- [ ] Failure path is observable.
- [ ] Queue selection/prioritization is intentional.
