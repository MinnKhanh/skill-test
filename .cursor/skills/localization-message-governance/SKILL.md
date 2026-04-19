---
name: localization-message-governance
description: Standardize multilingual API messages, validation text, and translation key governance in Laravel projects. Use when adding user-facing messages, validation errors, and business notifications.
---

# Localization Message Governance

## Rules

1. Use translation keys; avoid hard-coded user-facing strings.
2. Keep key namespaces domain-oriented and consistent.
3. Ensure parity across supported locales.
4. Separate technical logs from user-visible localized messages.

## Message Quality

- Keep messages concise and actionable.
- Use consistent terminology across all actor and API domains.
- Avoid ambiguous or implementation-heavy wording.

## Checklist

- [ ] New messages added in required locales.
- [ ] Key naming follows convention.
- [ ] Validation and business errors are localized.
- [ ] No mixed-language response content.
