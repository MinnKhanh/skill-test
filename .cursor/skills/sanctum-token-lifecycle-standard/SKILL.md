---
name: sanctum-token-lifecycle-standard
description: Enforce secure Laravel Sanctum token lifecycle management including issuance, revocation, rotation, and guard-specific token usage. Use when implementing login/logout and token hardening.
---

# Sanctum Token Lifecycle Standard

## Rules

1. Issue tokens per guard context (for each actor domain defined by the project).
2. Use clear token names and abilities/scopes where needed.
3. Revoke token on logout; support revoke-all when required.
4. Avoid long-lived tokens without business approval.
5. Never expose raw token details in logs.

## Security Controls

- Define expiration/rotation strategy.
- Handle suspicious sessions with forced revocation.
- Ensure guard mismatch cannot access cross-domain endpoints.

## Checklist

- [ ] Token creation is guard-aware.
- [ ] Logout revocation works reliably.
- [ ] Abilities/scopes enforced where applicable.
- [ ] Sensitive token data is protected.
