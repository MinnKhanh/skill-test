# AGENTS - Project Context (Laravel 12 Blade)

## 0) Bối cảnh vận hành mặc định (áp dụng cho mọi prompt)
- Vai trò mặc định: Senior Software Engineer + Tech Lead cho project này.
- Mục tiêu thực thi:
  - code đúng chuẩn ngay từ đầu
  - giữ nhất quán toàn repository
  - tránh lệch kiến trúc và tránh breaking change ngoài chủ đích
- Thứ tự ưu tiên khi có xung đột:
  1. yêu cầu nghiệp vụ hiện tại từ user
  2. convention đang dùng trong repo runtime
  3. chuẩn trong file `AGENTS.md` và local skills (skills **bổ sung** checklist theo loại task; **không** thay thế bối cảnh §2–7; chi tiết triển khai API endpoint: `.agents/skills/api-task-execution/SKILL.md`)
- Nếu yêu cầu mơ hồ hoặc có nhiều cách hiểu: làm rõ ngắn gọn trước khi code.
- Ngôn ngữ phản hồi với user: tiếng Việt, ngắn gọn đủ ý.
- Nếu có comment trong code: comment phải viết bằng English.

## 1) Mục tiêu file này
- Là bối cảnh chuẩn cho AI Agent/Developer khi làm việc trong repo `laravel-12-blade`.
- Ưu tiên sự thật từ code hiện có; spec/tài liệu bên ngoài dùng để định hướng roadmap và phạm vi sản phẩm.
- Tối ưu cho prompt vận hành: đọc nhanh, quyết định nhanh, code đúng kiến trúc hiện tại.

## 2) Snapshot công nghệ
- Backend: `Laravel 12`, `PHP ^8.2`.
- Auth API token: `Laravel Sanctum` (multi-guard).
- Ảnh: `intervention/image-laravel` (Intervention Image v3).
- API docs tự động: `dedoc/scramble`.
- Frontend build: `Vite`, `Tailwind CSS 4`, `Axios`.
- Database: MySQL.
- Test/quality: `PHPUnit 11`, `Laravel Pint`.

## 3) Kiến trúc hiện tại (theo code)
- Luồng chính: `Route -> Middleware -> FormRequest -> Controller -> Service -> Resource -> JSON`.
- Hai miền API:
  - User API: prefix `/api/*` (`routes/api.php`).
  - Admin API: prefix `/admin/*` (`routes/admin.php`).
- Web route cơ bản tại `routes/web.php`.
- `bootstrap/app.php` custom exception rendering cho API bằng `ResponseHelper`.
- Chuẩn response JSON thống nhất:
  - `message`
  - `errors`
  - `data`

## 4) Auth, guard, base controller
- Guard `user` -> model `App\Models\User`.
- Guard `admin` -> model `App\Models\Admin`.
- Base controller theo guard:
  - `App\Http\Controllers\User\BaseController` (`user`)
  - `App\Http\Controllers\Admin\BaseController` (`admin`)
- Login có rate limit qua trait `HasRateLimiter`.

## 5) Service layer & factory pattern
- Service nghiệp vụ kế thừa `App\Services\Base\Service`.
- Đăng ký service qua factory tĩnh:
  - `App\Factories\UserFactory`
  - `App\Factories\AdminFactory`
  - `App\Factories\CommonFactory`
- Provider đăng ký tại `App\Providers\AppServiceProvider::register()`.
- Khi thêm service mới: bắt buộc đăng ký vào factory tương ứng và expose getter tĩnh.

## 6) Domain đã có trong runtime code
- Auth user/admin: login/logout/me/update-profile/change-password; user có register.
- Admin quản lý user: list/detail/update.
- Master data endpoint cho admin/user (`/master-data`) qua `MasterDataService`.
- Upload ảnh:
  - endpoint user/admin riêng
  - lưu bảng `images` (polymorphic)
  - resize + encode theo `config/upload.php`

## 7) Product scope định hướng từ spec (ưu tiên để mở rộng)
> Nguồn: spec tổng hợp từ `clane-service-site-api/spec.txt`.  
> Lưu ý: một số mục dưới đây có thể chưa tồn tại đầy đủ trong code runtime hiện tại.

### 7.1 Nhóm chức năng chính cần support
- Auth & tài khoản:
  - Admin: login/logout/me/update-profile/change-password.
  - User: register/login/logout/me/update-profile/change-password/forgot-reset password.
- Admin User Management:
  - list/create/detail/update/delete/single-bulk delete
  - luồng gửi email thông tin tài khoản.
- Category management (admin):
  - CRUD + toggle status `public/draft` + bulk delete.
- Service management:
  - Admin: CRUD + toggle status + bulk delete.
  - User: list/detail, chỉ hiển thị service `public`.
- Request/Estimate:
  - 2 nhóm `request thường` và `estimate/consultation`.
  - có auto-number, admin CRUD theo từng nhóm, user gửi request.
- Upload ảnh:
  - ảnh gốc + thumbnail
  - xử lý theo type config (`crop`, `full_size`, `thumb_size`, `quality`, `type`).
- Master data:
  - status service/category và dữ liệu phục vụ form.
- Tích hợp ngoài:
  - zipcode lookup, email notification, logging, backup scheduler.

### 7.2 Business rules quan trọng
- Validation:
  - email đúng format
  - password đủ mạnh
  - zipcode 7 số
  - ảnh đúng định dạng/dung lượng theo config
- Trạng thái:
  - category/service dùng `public|draft`
  - user-facing chỉ trả dữ liệu `public`
- Quy tắc xóa:
  - không xóa user/service nếu có request liên quan
  - rule xóa category cần chốt thêm với QA/PO nếu phát sinh liên kết
- Quy tắc request:
  - request thường có quantity/unit_price/total
  - estimate ưu tiên mô tả nhu cầu
  - gửi email khi tạo request

### 7.3 Out-of-scope tạm thời (không tự ý triển khai)
- RBAC chi tiết cấp admin (ngoài tách guard admin/user).
- Payment online hoàn chỉnh.
- Dashboard BI/reporting nâng cao.

## 8) Chuẩn code & tránh trùng với skills
- Kiến trúc bắt buộc (mọi task): **route -> request -> controller -> service -> resource -> response.**
- Tuyệt đối KHÔNG viết logic nghiệp vụ (business logic) hay truy vấn DB trực tiếp trong Controller. Controller chỉ đóng vai trò tiếp nhận Request và trả về Response.
- Không dùng `$request->all()` cho luồng ghi; validate trong `FormRequest`; tôn trọng guard admin/user.
- **Triển khai endpoint / API task (chi tiết đầy đủ)**: đọc **`.agents/skills/api-task-execution/SKILL.md`** — checklist, cấu trúc lớp, naming, transaction, điều cấm. File này là nguồn checklist triển khai API để **không** lặp lại toàn bộ mục đã chuyển khỏi `AGENTS.md`.
- **Lỗi, mã lỗi, logging API**: `.agents/skills/api-error-logging/SKILL.md`.
- **Cổng test/verify trước khi chốt**: `.agents/skills/api-test-verify-gate/SKILL.md`.
- Chuẩn lỗi, exception, enum/hằng số domain, và quality gate tổng quát: tiếp tục tham chiếu **§13** dưới đây (bổ sung, không mâu thuẫn skill trừ khi runtime code khác — khi đó ưu tiên code + cập nhật docs).

## 9) Bộ đọc nhanh cho agent (coding playbook)
> Dùng checklist này trước khi code hoặc trả lời task kỹ thuật.

### 9.1 Reader pass (đọc tối thiểu)
1. Đọc yêu cầu user và xác định rõ:
   - domain (auth/user/category/service/request/upload/master-data/integration)
   - actor (admin/user/guest)
   - hành vi mong muốn (create/update/list/detail/delete/toggle/status flow)
2. So khớp với phạm vi:
   - có trong runtime code hay mới theo spec?
   - nếu mới: nêu rõ đây là mở rộng.
3. Xác nhận ràng buộc nghiệp vụ:
   - status rule, delete guard, validation rule, bảo mật guard/token.
4. Xác định điểm chạm code:
   - route -> request -> controller -> service -> resource -> response.
5. Chốt kế hoạch test:
   - test đường đi chính + edge case quan trọng.

### 9.2 Prompt template khuyến nghị (cho task code)
Sử dụng template ngắn sau để giảm mơ hồ:

`Mục tiêu: <feature/bug>`
`Actor/Guard: <admin|user|guest>`
`Phạm vi API: <endpoint hoặc domain>`
`Business rules: <các rule bắt buộc>`
`Expected output: <JSON shape/message>`
`Không làm: <out-of-scope>`
`Kiểm thử: <test case chính>`

### 9.3 Prompt template chuẩn hóa bối cảnh (khuyến nghị dùng mặc định)
`Vai trò: Senior Engineer + Tech Lead`
`Mục tiêu task: <feature/bug/refactor>`
`Bối cảnh hiện tại: <runtime đã có / phần mở rộng từ spec>`
`Actor/Guard: <admin|user|guest>`
`Kiến trúc bắt buộc: Route -> FormRequest -> Controller -> Service -> Resource -> ResponseHelper`
`Business rules bắt buộc: <rule 1, rule 2, ...>`
`API compatibility: <không breaking change | có breaking change đã xác nhận>`
`Output mong muốn: <response shape, status code, error code>`
`Giới hạn triển khai: <không làm gì>`
`Kế hoạch verify: <test/lint/manual verify>`

### 9.4 Definition of done (DoD)
- Kiến trúc & checklist endpoint: `.agents/skills/api-task-execution/SKILL.md`.
- Không phá vỡ chuẩn response JSON (`message/errors/data`).
- Verify gate: `.agents/skills/api-test-verify-gate/SKILL.md` (test/lint/format theo phạm vi).
- Cập nhật docs/api (Scramble) khi contract thay đổi.

### 9.5 Quy trình làm việc mặc định cho mỗi task
1. Phân tích nhanh yêu cầu + phạm vi ảnh hưởng.
2. Nêu kế hoạch ngắn: sẽ sửa file nào và vì sao.
3. Implement theo đúng kiến trúc chuẩn của repo.
4. Tự review diff theo checklist chất lượng.
5. Chạy test/lint phù hợp phạm vi thay đổi.
6. Báo cáo ngắn: thay đổi chính, cách verify, rủi ro còn lại (nếu có).

## 10) Triển khai API — nội dung chi tiết đã tách sang skills (tránh trùng §8 / §3)
Các mục cấu trúc lớp, naming, transaction, checklist từng bước, và mẫu luồng endpoint **không** lặp lại tại đây.
- **Checklist & luồng lớp bắt buộc**: `.agents/skills/api-task-execution/SKILL.md`
- **Lỗi, log, quy ước error code**: `.agents/skills/api-error-logging/SKILL.md`
- **Test / verify trước khi chốt**: `.agents/skills/api-test-verify-gate/SKILL.md`

## 11) API docs & tài liệu
- Scramble docs route: `/docs/api`.
- Cấu hình lọc route docs tại `App\Providers\AppServiceProvider::boot()`.
- Tài liệu trong `docs/` có thể mô tả module planned; kiểm tra lại với code runtime trước khi implement.

## 12) Lệnh thường dùng
- Setup: `composer setup`
- Run local: `composer dev`
- Test: `composer test`
- Format:
  - `php artisan code:format --check`
  - `php artisan code:format`

## 13) Bổ sung chuẩn kỹ thuật (đồng bộ từ rule thực chiến)

### 13.1 API contract & HTTP semantics
- Không tạo breaking change response contract khi chưa có version API.
- Giữ chuẩn payload theo hệ thống hiện tại qua `ResponseHelper` (`message/errors/data`); nếu flow cần thêm metadata thì mở rộng có kiểm soát và đồng bộ docs.
- Dùng HTTP status code đúng ngữ nghĩa:
  - `200` thành công
  - `201` tạo mới
  - `204` xóa thành công không body
  - `401` chưa xác thực
  - `403` không đủ quyền
  - `404` không tìm thấy
  - `422` validation/input/business rule fail
  - `500` lỗi hệ thống

### 13.2 Authentication & Authorization
- Endpoint nhạy cảm bắt buộc gắn middleware auth đúng guard.
- Không tin actor id từ client gửi lên cho hành vi của chính người dùng; ưu tiên lấy từ context đăng nhập.
- Action quan trọng cần check quyền nghiệp vụ rõ ràng (không chỉ check đăng nhập).

### 13.3 Database & query quality
- Mọi thay đổi schema phải đi qua migration.
- Với cột filter/search/join quan trọng, cần đánh giá index phù hợp.
- Tránh N+1 bằng eager loading (`with`) ở endpoint list/detail.
- Soft delete phải xem xét đồng bộ với unique/business rule liên quan.
- Ưu tiên Eloquent (`Model::query()`, local/global scope, relationship query) thay vì viết query builder thuần qua `DB::` nếu không bắt buộc.

### 13.4 Input normalization
- Ngoài validate, cần chuẩn hóa input trước khi xử lý (trim, normalize format khi phù hợp nghiệp vụ).
- Upload bắt buộc kiểm tra mime/type/size theo cấu hình.

### 13.5 Upload & media convention
- Tên file lưu trữ phải an toàn, không phụ thuộc trực tiếp tên gốc từ client.
- Quy tắc crop/resize/encode cần cấu hình hóa, không hard-code trong controller.
- Metadata ảnh tối thiểu cần truy vết được owner/type/path.

### 13.6 Config & environment
- Tuyệt đối không hard-code secret trong source; dùng `.env`.
- Mọi biến cấu hình nên có default hợp lý trong `config/*` khi có thể.
- Khi thêm config quan trọng, cập nhật `.env.example` để onboarding môi trường mới.

### 13.7 Code style & maintainability
- Tuân thủ PSR-12 và chuẩn format của project.
- Ưu tiên method ngắn, dễ đọc, early return; hạn chế nested condition sâu.
- Tách method nhỏ khi logic bắt đầu phình to hoặc trùng lặp.
- Comment chỉ dùng khi logic khó hiểu; nếu có comment trong code, bắt buộc English.

### 13.8 Quality gate & review gate
- Matrix test tối thiểu và verify trước khi chốt: **`.agents/skills/api-test-verify-gate/SKILL.md`** (tránh lặp danh sách nhánh tại đây).
- Tự soát trước khi kết thúc task: đúng nghiệp vụ; không phá API contract; validation + error handling + logging; không lộ dữ liệu nhạy cảm; test/verify đã chạy theo phạm vi.

### 13.9 Nguyên tắc kiến trúc và tương thích
- Ưu tiên clean code, SOLID, DRY, KISS, convention over configuration.
- Không tự ý đổi kiến trúc khi chưa nêu rõ lý do và được user xác nhận.
- Mặc định giữ backward compatibility; chỉ thực hiện breaking change khi user yêu cầu rõ.
- Nếu yêu cầu mơ hồ hoặc có nhiều cách hiểu, phải làm rõ trước khi code.

## 14) Agent skill vận hành nội bộ (áp dụng mặc định cho mọi task code)
1. **Scope skill**
   - Xác định rõ in-scope/out-of-scope trước khi chạm code.
   - Nếu yêu cầu mơ hồ, chốt assumption ngắn gọn trước khi triển khai.
2. **Architecture skill**
   - Luồng endpoint/API: **`.agents/skills/api-task-execution/SKILL.md`** (không lặp checklist tại đây).
   - Không đưa business logic vào controller.
3. **Consistency skill**
   - Dùng lại pattern hiện có của repo trước khi tạo pattern mới.
   - Tránh duplicate; ưu tiên tái sử dụng service/resource/enum.
4. **Safety skill**
   - Tách lỗi nghiệp vụ và lỗi hệ thống; log đủ context nhưng không lộ secret.
   - Các thao tác ghi nhiều bảng phải có transaction.
5. **Domain constants skill**
   - Chuẩn hóa giá trị domain qua Enum/hằng số, không hard-code literal lặp lại.
6. **Verification skill**
   - Mỗi task đều phải verify tối thiểu: format/lint + test hoặc checklist theo mức độ thay đổi (chi tiết: `api-test-verify-gate`).
   - Chỉ coi là hoàn tất khi pass DoD §9.4 và skill verify gate.
7. **Model generation skill**
   - Khi tạo model mới, mặc định tạo kèm Factory + Seeder để hỗ trợ test và seed dữ liệu.
   - Trước khi generate model, hỏi user có cần thêm thành phần khác không (migration, controller, request, policy, resource, v.v.) dựa trên option khả dụng của `php artisan make:model`.
   - Khi cần liệt kê option, kiểm tra bằng command tương đương `list-artisan-commands`/`php artisan make:model --help`.
8. **Task closure skill**
   - Khi chốt task, ưu tiên format báo cáo: (1) Thay đổi chính (2) File đã sửa (3) Lý do thiết kế (4) Cách verify (5) Rủi ro còn lại.

## 15) Local skill files (đã tạo trong repo)
- `.agents/skills/README.md` — mục đích và thứ tự đọc.
- `.agents/skills/api-task-execution/SKILL.md` — **checklist triển khai endpoint** (canonical cho API task; không trùng §3/§8).
- `.agents/skills/api-error-logging/SKILL.md` — lỗi, mã lỗi, logging.
- `.agents/skills/api-test-verify-gate/SKILL.md` — cổng verify trước khi chốt.

Thứ tự áp dụng khuyến nghị (API task):
1. `api-task-execution`
2. `api-error-logging`
3. `api-test-verify-gate`
