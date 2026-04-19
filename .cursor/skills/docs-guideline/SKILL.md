---
name: docs-guideline
description: Produce consistent technical documentation for API features, business rules, and delivery notes. Use when writing specs, API docs, changelogs, implementation notes, and QA/UAT checklists.
---

# Docs Guideline

## Documentation Types

- Spec: business goals, actors, scope, rules, open questions.
- API doc: endpoint, auth, request schema, response schema, error codes.
- Change note: why changed, impact, migration/rollback notes.
- QA note: test scenarios, expected results, edge cases.

## Writing Rules

1. Write concise, structured sections with explicit headings.
2. Separate facts, assumptions, and open questions.
3. Keep terms consistent across all documents.
4. Avoid implementation noise in product-level docs.
5. Include examples for request/response when documenting APIs.

## API Doc Template

1. Endpoint + method
2. Auth requirement
3. Request fields (type, required, validation)
4. Success response example
5. Error response examples
6. Business notes and constraints

## Quality Checklist

- [ ] Scope is clear.
- [ ] No contradictory terms.
- [ ] All required fields documented.
- [ ] Error behavior documented.
- [ ] Risks/open questions captured.
