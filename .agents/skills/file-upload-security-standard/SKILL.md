---
name: file-upload-security-standard
description: Implement, refactor, secure, or review Laravel file and media handling. Use for image upload, avatar upload, document upload, validation, MIME/size limits, storage disks, generated filenames, Intervention Image resizing/cropping, thumbnails, metadata, owner scoping, cleanup, and download/exposure safety.
---

# File Upload Security Standard

Use whenever a feature accepts, stores, transforms, links, displays, or deletes uploaded files.

## Project Context

- Upload config lives in `config/upload.php`.
- Uploaded images are tracked in the polymorphic `images` table.
- Image processing uses Intervention Image v3.
- User/admin upload endpoints are separate.

## Rules

1. Validate file type, mime, dimensions, and size in FormRequest/config.
2. Generate safe storage names; never trust the original filename.
3. Keep processing options configurable: crop, full size, thumbnail size, quality, output type.
4. Store enough metadata to trace owner, model/type, path, and thumbnail.
5. Keep controller free of upload and image processing logic.
6. Clean up files when a DB write fails, or use a transaction-compatible strategy.
7. Never expose private storage paths directly.

## Checklist

- [ ] Validation uses configured limits.
- [ ] Storage disk/path is intentional.
- [ ] Original and thumbnail behavior is clear.
- [ ] Metadata is persisted.
- [ ] Failure cleanup path is handled.
