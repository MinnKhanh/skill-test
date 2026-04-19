# 01 - Auth & Account

## Scope
- Admin: login, logout, me, update-profile, change-password
- User: register, login, logout, me, update-profile, change-password, forgot-password, reset-password

## Rules
- Endpoint bảo mật bắt buộc auth token đúng guard.
- Không tin actor id từ client; lấy từ auth context.
- Password theo policy mạnh.
- Response thống nhất qua `ResponseHelper`.

## API groups
- Admin auth APIs
- User auth/profile APIs

## Test tối thiểu
- success
- invalid input
- unauthorized/forbidden
- business rule fail (nếu có)
