# 02 - User Management (Admin)

## Scope
- list users
- create user
- detail user
- update user
- delete user
- bulk delete users
- gửi email thông tin tài khoản khi tạo user (nếu bật flow)

## Rules
- Không cho xóa user nếu đã có request liên quan.
- Validate đầy đủ: type/format/exists/unique theo nghiệp vụ.
- Dùng `Model::query()` + eager loading khi cần để tránh N+1.

## Test tối thiểu
- success CRUD
- validation fail
- not found
- unauthorized/forbidden
- delete bị chặn do business rule
