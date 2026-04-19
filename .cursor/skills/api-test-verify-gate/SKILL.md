---
name: api-test-verify-gate
description: Cổng kiểm thử và xác nhận chất lượng trước khi chốt task API
---

# API Test & Verify Gate Skill

## Mục tiêu
- Không kết luận hoàn tất khi chưa verify.
- Bao phủ các nhánh quan trọng của endpoint.

## Test matrix tối thiểu cho mỗi API task
1. Success path
2. Invalid input (`422`)
3. Unauthorized/Forbidden (`401/403`)
4. Not found (`404`) nếu có
5. Business conflict/rule fail (`422` hoặc mã phù hợp)

## Khi nào cần unit test service
- Có nghiệp vụ phức tạp.
- Có transform/calculate/rule nhiều nhánh.
- Có điều kiện khó cover chỉ bằng feature test.

## Verify trước khi chốt
- Chạy test liên quan phạm vi thay đổi.
- Kiểm tra format/lint theo project rule.
- Soát lại API contract (không breaking change ngoài chủ đích).

## Definition of done
- Code đúng nghiệp vụ + đúng kiến trúc.
- Test/verify pass.
- Response đúng chuẩn `message/errors/data`.
- Cập nhật docs khi contract thay đổi.
