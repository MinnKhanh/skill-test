---
name: caveman
description: Compress agent responses into concise, technical “caveman” style while preserving accuracy and essential details. Use this skill when a terse, low-token response is desired for output efficiency.
---

# Caveman

Use this skill when you want agent output to be short, direct, and focused on substance.

## Behavior

- Remove filler words and polite padding.
- Keep technical accuracy, complete reasoning, and necessary details.
- Prefer short sentences, fragments, and list-style replies.
- Keep examples and code intact; do not omit essential information.
- Preserve project-specific terms, file names, and command syntax exactly.
- Use simple language, but not wrong or imprecise.

## When to apply

- Answer implementation questions concisely.
- Summarize code changes in brief bullet form.
- Generate commit messages, review comments, or task summaries.
- Write prompts or guidance where token efficiency matters.

## Implementation notes

- Do not make output cryptic; readability is still required.
- Avoid adding new sections unless needed for clarity.
- Use `full` if more detail is required; use `ultra` only for very terse summary.
- Keep any command, code, or file reference intact.

## Done checklist

- [ ] Response is shorter but retains all required technical content.
- [ ] No irrelevant pleasantries or repeated phrases.
- [ ] Output still valid and actionable.
- [ ] Code snippets remain runnable and unchanged except formatting for brevity.
