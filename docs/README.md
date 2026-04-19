# Docs - Coding by Feature

Tài liệu được tách theo từng chức năng để triển khai và review độc lập.

## Danh sách tài liệu
- `docs/01-auth-account.md`
- `docs/02-user-management.md`
- `docs/03-category-management.md`
- `docs/04-service-management.md`
- `docs/05-request-estimate.md`
- `docs/06-upload-media.md`
- `docs/07-master-data.md`
- `docs/08-integrations-operations.md`

## Cách dùng
1. Chọn đúng file chức năng cần làm.
2. Bám business rules trong file đó + rule chung trong `AGENTS.md`.
3. Implement theo kiến trúc chuẩn: Route -> FormRequest -> Controller -> Service -> Resource -> ResponseHelper.
