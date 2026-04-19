---
name: laravel-transaction-standard
description: Apply safe Laravel transaction patterns for multi-step writes and consistency-critical operations. Use when implementing create/update/delete flows that touch multiple tables or side effects.
---

# Laravel Transaction Standard

## When Transaction Is Required

- One request writes to multiple tables.
- A write depends on prior write success.
- Business invariants must remain atomic.
- Sequence/code generation can race under concurrency.

## Rules

1. Wrap critical writes in `DB::transaction`.
2. Keep transaction blocks small and deterministic.
3. Throw exceptions to trigger rollback.
4. Do not perform slow external IO inside transaction when avoidable.
5. Log failure context after rollback.

## Pattern

1. Validate input.
2. Start transaction.
3. Execute DB writes.
4. Commit automatically on success.
5. Perform non-critical side effects (email/notify) after commit if possible.

## Checklist

- [ ] Atomic boundary is correct.
- [ ] Rollback path tested.
- [ ] No partial data on failure.
- [ ] Concurrency risks reviewed.
