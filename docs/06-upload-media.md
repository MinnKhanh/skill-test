# 06 - Upload & Media

## Scope
- Upload ảnh qua API
- Tạo bản gốc + thumbnail
- Lưu metadata phục vụ truy vết

## Rules
- Kiểm tra mime/type/size theo config.
- Xử lý theo type config: `crop`, `full_size`, `thumb_size`, `quality`, `type`.
- Encode/lưu theo chuẩn hệ thống (webp nếu config quy định).
- Không dùng tên file gốc từ client làm tên lưu chính.

## Test tối thiểu
- upload success
- invalid file format/size
- unauthorized/forbidden
- metadata lưu đúng (owner/type/path)
