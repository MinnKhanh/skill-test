# 03 - Category Management (Admin)

## Scope
- list/create/detail/update/delete
- bulk delete
- toggle status category

## Rules
- Status chỉ dùng `public|draft`.
- Nếu category đang liên kết service, rule delete cần theo quyết định QA/PO.
- Dữ liệu trả về qua Resource để tái sử dụng.

## Test tối thiểu
- create/update/delete success
- toggle status success
- validation fail
- not found
- forbidden/unauthorized
