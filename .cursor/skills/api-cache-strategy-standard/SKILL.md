---
name: api-cache-strategy-standard
description: Define safe and maintainable cache strategy for Laravel APIs including keys, TTL, invalidation, and stale data controls. Use when optimizing read-heavy endpoints and master data APIs.
---

# API Cache Strategy Standard

## Rules

1. Cache only data with clear invalidation strategy.
2. Use stable key naming with domain prefixes.
3. Set TTL by data volatility and business tolerance.
4. Invalidate cache on writes that affect cached reads.
5. Avoid caching user-sensitive data without strict key scoping.

## Good Candidates

- Master data
- Public service/category listings
- Low-volatility reference endpoints

## Checklist

- [ ] Cache key schema documented.
- [ ] TTL justified.
- [ ] Invalidation path implemented.
- [ ] No stale critical data risk.
