# 07 - Master Data

## Scope
- API master data cho admin và user
- Nhóm dữ liệu chính:
  - service status
  - category status
  - category/form supporting data

## Rules
- Dùng cấu trúc output ổn định, dễ tái sử dụng cho nhiều màn hình/form.
- Tránh hard-code giá trị trạng thái trong controller/service; ưu tiên Enum/constant.
- Tối ưu query trả dữ liệu nhẹ, phù hợp endpoint dùng nhiều.

## Test tối thiểu
- response đầy đủ theo từng nhóm master data
- unauthorized/forbidden (nếu endpoint bảo mật)
- contract ổn định không phá frontend dùng chung
