---
name: api-versioning-backward-compatibility
description: Govern Laravel API versioning and backward compatibility to prevent client breakage during feature evolution. Use when changing endpoint contracts, semantics, or response fields.
---

# API Versioning Backward Compatibility

## Core Rules

1. Treat contract changes as versioning events.
2. Add fields in backward-compatible way before removing old ones.
3. Define deprecation windows and migration guidance.
4. Keep old clients functional during transition.

## Compatibility Checklist

- [ ] Contract diff reviewed.
- [ ] Client impact documented.
- [ ] Deprecation notice prepared.
- [ ] Version routing/strategy is explicit.
