---
name: deployment-safe-migration-release
description: Apply deployment-safe Laravel migration and release practices with backward compatibility, rollout sequencing, and rollback readiness. Use when shipping schema or behavior changes to production.
---

# Deployment Safe Migration Release

## Release Rules

1. Prefer expand-and-contract pattern for risky schema changes.
2. Keep app code compatible with both old and new schema during rollout.
3. Avoid long-lock operations during peak traffic.
4. Prepare rollback steps before release.

## Sequence

1. Deploy backward-compatible code.
2. Run safe migration.
3. Enable new behavior/flags.
4. Monitor and validate.
5. Remove legacy paths in later release.

## Checklist

- [ ] Migration is production-safe.
- [ ] Rollback plan exists and tested.
- [ ] Queue/scheduler compatibility reviewed.
- [ ] Post-deploy verification defined.
