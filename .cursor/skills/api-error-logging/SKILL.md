---
name: api-error-logging
description: Chuẩn hóa lỗi API, mã lỗi và logging có ngữ cảnh
---

# API Error & Logging Skill

## Mục tiêu
- Tách bạch lỗi nghiệp vụ và lỗi hệ thống.
- Trả mã lỗi nhất quán để frontend xử lý ổn định.
- Log đủ context để debug nhanh, không lộ dữ liệu nhạy cảm.

## Quy tắc bắt buộc
- Lỗi nghiệp vụ dự kiến: trả `4xx` với `error_code` rõ nghĩa.
- Lỗi không kiểm soát: log chi tiết, trả response an toàn `5xx`.
- Không trả stack trace nội bộ cho client.

## Format mã lỗi
- Chuẩn: `{DOMAIN}_{ACTION}_{REASON}`
- Ví dụ:
  - `USER_DELETE_HAS_REQUESTS`
  - `SERVICE_UPDATE_INVALID_STATUS`

## Log context tối thiểu
- `actor_type` (`admin|user|system`)
- `actor_id`
- `action` / `domain`
- input đã sanitize
- exception message + trace (cho lỗi hệ thống)

## Tuyệt đối không log
- password
- token thô
- secret key

## Checklist nhanh
- [ ] HTTP status đúng semantic
- [ ] Có `error_code` ổn định
- [ ] Log có đủ context
- [ ] Không lộ dữ liệu nhạy cảm
