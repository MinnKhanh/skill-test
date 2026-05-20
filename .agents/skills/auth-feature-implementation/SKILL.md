---
name: auth-feature-implementation
description: Implement, refactor, secure, or review Laravel authentication and account features. Use for login, logout, registration, forgot password, reset password, change password, profile/me endpoints, sessions, Sanctum tokens, guards, middleware, rate limits, credential validation, account recovery, and auth-related UI or API flows.
---

# Auth Feature Implementation

Use for auth-related web or API work. Combine it with the repository's normal backend, UI, validation, security, and verification practices as needed.

## Project Context

- User guard: `user`, model `App\Models\User`.
- Admin guard: `admin`, model `App\Models\Admin`.
- Token auth uses Laravel Sanctum.
- User controllers live under `App\Http\Controllers\User`.
- Admin controllers live under `App\Http\Controllers\Admin`.
- Existing auth services live under `App\Services\User\AuthService` and `App\Services\Admin\AuthService`.

## Rules

1. Never trust actor ids supplied by the client for self-service actions; use the authenticated actor.
2. Keep guard behavior explicit and prevent cross-guard access.
3. Put validation in guard-specific FormRequests.
4. Apply rate limiting to login, forgot password, reset password, and other anonymous sensitive endpoints.
5. Revoke the current token on logout; support revoke-all only when required.
6. Never log raw tokens, passwords, reset tokens, or credential payloads.
7. Use existing `Password` and uniqueness rules unless the feature needs a documented change.

## Token Checklist

- [ ] Token name identifies actor domain.
- [ ] Token abilities are used only when the project needs them.
- [ ] Logout revokes the correct token.
- [ ] Token response exposes only the raw token once.

## Finish

Run relevant auth feature tests or manually verify the auth flow, then complete the repository's normal quality gate.
