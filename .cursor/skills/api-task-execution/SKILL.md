---
name: api-task-execution
description: Triển khai endpoint API theo chuẩn Service + FormRequest + Resource
---

# API Task Execution Skill (Laravel 12)

## Mục tiêu
- Bảo đảm mọi API task đi đúng kiến trúc của project.
- Không để business logic trong controller.
- Tối ưu khả năng tái sử dụng và maintain.
- Giữ backward compatibility mặc định, trừ khi user yêu cầu breaking change.

## Bắt buộc khi triển khai
1. Xác định `guard` và route group (`admin` hoặc `user`).
2. Tạo `FormRequest` riêng theo action (`Store*Request`, `Update*Request`, `*IndexRequest`).
3. Đưa toàn bộ nghiệp vụ vào `Service`.
4. Trả dữ liệu bằng `Resource`/`ResourceCollection`.
5. Trả response qua `ResponseHelper` với cấu trúc `message/errors/data`.
6. Dùng `Enum` hoặc hằng số cho giá trị domain lặp lại.
7. Với truy vấn dữ liệu, ưu tiên Eloquent (`Model::query()`, scope, relation) để tận dụng ORM.
8. Khi tạo model mới, tạo kèm Factory + Seeder.
9. Trước khi chạy lệnh tạo model, hỏi user có cần thêm thành phần generate không (migration, controller, policy, resource, requests, v.v.) dựa trên option của `php artisan make:model`.

## Không được làm
- Không validate trực tiếp trong controller.
- Không dùng `$request->all()` cho luồng ghi dữ liệu.
- Không hard-code status/type/code lặp lại trong service/controller/request.
- Hạn chế dùng `DB::` cho query nghiệp vụ thông thường khi có thể giải bằng Eloquent.
- Không tự ý đổi kiến trúc nếu chưa nêu rõ lý do và chưa được user xác nhận.

## Mẫu flow endpoint
1. Route -> 2. FormRequest -> 3. Controller (orchestrate only)  
4. Service (business logic + transaction nếu cần) -> 5. Resource -> 6. ResponseHelper

## Quy trình thực hiện task
1. Phân tích yêu cầu + phạm vi ảnh hưởng.
2. Nêu kế hoạch sửa file ngắn gọn trước khi sửa.
3. Implement theo kiến trúc chuẩn.
4. Tự review diff theo checklist.
5. Chạy test/lint phù hợp phạm vi thay đổi.
6. Chốt theo format: thay đổi chính, file đã sửa, lý do thiết kế, cách verify, rủi ro còn lại.

## Checklist nhanh
- [ ] Guard đúng
- [ ] FormRequest riêng cho action
- [ ] Service xử lý nghiệp vụ
- [ ] Resource cho output
- [ ] Enum/const cho giá trị domain
- [ ] Query theo Eloquent (`Model::query()`) thay vì `DB::` nếu không bắt buộc
- [ ] Model mới có Factory + Seeder
- [ ] Không tạo breaking change ngoài chủ đích
- [ ] Đã chạy test/lint hoặc nêu rõ phần chưa chạy
