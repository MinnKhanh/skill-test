---
name: file-upload-security-standard
description: Enforce secure Laravel file upload handling with validation, storage hygiene, and lifecycle management. Use when implementing image or document upload features.
---

# File Upload Security Standard

## Core Rules

1. Validate MIME type and file size strictly.
2. Use generated safe filenames; never trust original names.
3. Store files in controlled paths with clear visibility settings.
4. Normalize/transform uploads only through approved pipelines.
5. Clean orphaned files on rollback/delete flows.

## Additional Controls

- Validate image dimensions when business requires fixed aspect/size.
- Block executable content and suspicious extensions.
- Log upload failures with sanitized metadata.

## Checklist

- [ ] Validation rules are strict and explicit.
- [ ] Path and naming are secure.
- [ ] Access policy (public/private) is defined.
- [ ] Cleanup and delete behavior are implemented.
