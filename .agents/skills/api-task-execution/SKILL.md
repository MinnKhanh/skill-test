---
name: api-task-execution
description: Implement, refactor, or review Laravel backend/API features. Use for routes, middleware, FormRequests, controllers, services, resources, response contracts, CRUD actions, list/detail endpoints, business logic, validation flow, or any backend feature that should follow a layered Laravel architecture.
---

# API Task Execution

Use this skill for Laravel backend work after reading the project-level context that exists in the current repository.

## Required Flow

Implement API behavior through:

`Route -> Middleware -> FormRequest -> Controller -> Service -> Resource -> ResponseHelper`

- User API routes: `routes/api.php`, prefix `/api/*`.
- Admin API routes: `routes/admin.php`, prefix `/admin/*`.
- Responses must keep the project envelope: `message`, `errors`, `data`.

## Implementation Rules

1. Identify actor and guard first: `user`, `admin`, or guest.
2. Put validation and input normalization in a dedicated `FormRequest`.
3. Keep controllers thin: accept request, call service, return response/resource.
4. Put business logic, queries, transactions, and external calls in services.
5. Register new services in `UserFactory`, `AdminFactory`, or `CommonFactory`.
6. Return output through Resource/Collection when data shape is not trivial.
7. Use enums/constants/config for repeated domain values.
8. Prefer Eloquent queries and eager loading over raw `DB::` usage.
9. Preserve backward compatibility unless the user explicitly approves a breaking change.

## Transactions

Use service-level transactions when:

- writing more than one table,
- DB writes depend on file/email/external side effects,
- partial persistence would leave inconsistent business state.

Never open transactions in controllers.

## Related Concerns

When the requested feature also touches authentication, upload/media, email, third-party integrations, documentation, or verification, apply the matching project guidance for that concern. Do not force a specific workflow file; infer the needed guidance from the task and the repository.

## Done Checklist

- [ ] Correct route file, prefix, guard, and middleware.
- [ ] Dedicated FormRequest for write or filter-heavy input.
- [ ] No business logic in controller.
- [ ] Service registered in the right factory when new.
- [ ] Response uses project envelope and expected HTTP status.
- [ ] Tests/lint/format run or clearly reported if blocked.
