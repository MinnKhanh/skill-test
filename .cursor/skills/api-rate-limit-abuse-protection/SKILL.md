---
name: api-rate-limit-abuse-protection
description: Apply endpoint-level rate limiting and abuse protections for Laravel APIs, especially authentication and public routes. Use when securing login, forgot password, upload, and anonymous endpoints.
---

# API Rate Limit Abuse Protection

## Core Rules

1. Define tighter limits for sensitive endpoints.
2. Use appropriate keys (IP, user/account, guard context).
3. Distinguish burst handling and sustained rate control.
4. Return predictable throttle responses.

## Target Endpoints

- Login
- Forgot/reset password
- Public request submission
- Upload endpoints

## Checklist

- [ ] Limits are business-justified.
- [ ] Key strategy prevents easy bypass.
- [ ] User feedback for throttling is clear.
- [ ] Monitoring exists for abuse spikes.
