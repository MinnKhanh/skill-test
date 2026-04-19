# 05 - Request & Estimate Consultation

## Scope
- User submit request
- Admin list/detail/update/delete request
- Phân tách 2 nhóm:
  - request thường
  - estimate/consultation

## Rules
- Request có mã đơn auto-number.
- Request thường có `quantity`, `unit_price`, `total`.
- Estimate/consultation ưu tiên mô tả nhu cầu.
- Phát sinh request cần trigger email thông báo.

## Test tối thiểu
- submit request success
- admin quản lý request success
- validation fail
- unauthorized/forbidden
- auto-number sinh đúng format (nếu có quy chuẩn cụ thể)
