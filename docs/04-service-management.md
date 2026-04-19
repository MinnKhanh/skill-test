# 04 - Service Management (Admin + User)

## Scope
### Admin APIs
- CRUD service
- toggle status
- delete + bulk delete

### User APIs
- list service
- detail service

## Rules
- User-facing chỉ hiển thị service có status `public`.
- Status service chỉ dùng `public|draft`.
- Không cho xóa service nếu đã phát sinh request liên quan.

## Test tối thiểu
- admin CRUD success
- user list/detail chỉ thấy `public`
- validation fail
- not found
- business rule fail khi delete
