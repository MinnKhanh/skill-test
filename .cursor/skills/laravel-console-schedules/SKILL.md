---
name: laravel-console-schedules
description: Standardize Laravel Artisan command and scheduler implementation for reliable automation, observability, and safe operations. Use when adding commands, cron schedules, and maintenance jobs.
---

# Laravel Console Schedules

## Command Rules

1. Command signature and description must be explicit.
2. Keep command idempotent where feasible.
3. Validate required options/arguments early.
4. Return proper exit codes.

## Scheduler Rules

- Register schedule in `app/Console/Kernel.php`.
- Define frequency with timezone awareness.
- Use `withoutOverlapping()` for non-reentrant jobs.
- Use `onOneServer()` in distributed environments when needed.
- Add logging/notification for failures.

## Operational Safety

- Avoid destructive behavior by default.
- Support dry-run mode for sensitive commands.
- Keep long jobs queued where appropriate.

## Checklist

- [ ] Command is discoverable and documented.
- [ ] Schedule frequency is business-approved.
- [ ] Overlap/concurrency protection configured.
- [ ] Failures are observable.
