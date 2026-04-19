# 08 - Integrations & Operations

## Scope
- Zipcode lookup integration
- Email notification cho event nghiệp vụ
- Logging vận hành
- Backup scheduler

## Rules
- Tách layer gọi dịch vụ ngoài trong service/integration class phù hợp.
- Lỗi từ dịch vụ ngoài phải được chuẩn hóa error response, không lộ chi tiết nhạy cảm.
- Logging đủ context để debug, không log secret/token/password.
- Backup phải chạy theo lịch cấu hình môi trường.

## Test/Verify tối thiểu
- zipcode lookup success/fail path
- email job dispatch khi event nghiệp vụ phát sinh
- logging có context cơ bản
- scheduler backup được đăng ký đúng
