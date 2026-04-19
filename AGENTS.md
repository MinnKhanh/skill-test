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
  3. chuẩn trong file `AGENTS.md` và local skills
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

## 8) Chuẩn code bắt buộc trong project
- Không dùng `$request->all()`, chỉ lấy field cần qua `$request->only([...])` hoặc tương đương tường minh.
- Validate bắt buộc đặt trong `FormRequest` riêng cho từng action (create/update/filter...), không viết validate trực tiếp trong controller.
- Business logic + query DB bắt buộc đặt ở `Service`; controller chỉ điều phối request/response, không chứa xử lý nghiệp vụ.
- Tránh `DB::` query builder cho nghiệp vụ thông thường; ưu tiên Eloquent với `Model::query()` + scope/relation để tận dụng ORM.
- Ưu tiên `ResponseHelper` để giữ chuẩn JSON nhất quán.
- Tác vụ nhiều bảng/phức tạp: dùng transaction tại service.
- Tôn trọng boundaries guard admin/user, tránh trộn flow.
- Dữ liệu trả về API phải đi qua `Resource` để tái sử dụng; nếu nhiều endpoint cùng kiểu dữ liệu thì dùng chung `Resource`/`ResourceCollection` thay vì lặp mapping.
- Chuẩn lỗi phải nhất quán: trả về message rõ nghĩa, có error code phù hợp ngữ cảnh, và log đầy đủ để truy vết (input quan trọng, actor, exception, context xử lý).
- Exception handling cần phân tầng:
  - lỗi nghiệp vụ dự kiến -> trả mã lỗi nghiệp vụ phù hợp (4xx)
  - lỗi hệ thống/ngoại lệ không kiểm soát -> log chi tiết + trả response an toàn (5xx)
- Các giá trị cố định (status, type, action, channel, code...) phải khai báo rõ:
  - ưu tiên `Enum` khi là tập giá trị hữu hạn có ngữ nghĩa domain
  - dùng hằng số trong model/class khi phù hợp ngữ cảnh kỹ thuật hoặc scope hẹp
  - không hard-code literal lặp lại trong controller/service/request

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
- Chạy đúng theo kiến trúc service-layer hiện có.
- Không phá vỡ chuẩn response JSON (`message/errors/data`).
- Pass test liên quan; không phát sinh lỗi lint/format.
- Cập nhật docs/api annotations khi endpoint thay đổi.

### 9.5 Quy trình làm việc mặc định cho mỗi task
1. Phân tích nhanh yêu cầu + phạm vi ảnh hưởng.
2. Nêu kế hoạch ngắn: sẽ sửa file nào và vì sao.
3. Implement theo đúng kiến trúc chuẩn của repo.
4. Tự review diff theo checklist chất lượng.
5. Chạy test/lint phù hợp phạm vi thay đổi.
6. Báo cáo ngắn: thay đổi chính, cách verify, rủi ro còn lại (nếu có).

## 10) Chuẩn triển khai API chi tiết (thực thi bắt buộc)

### 10.1 Cấu trúc lớp theo endpoint
Mỗi endpoint CRUD hoặc action quan trọng cần có đầy đủ các lớp sau (trừ khi có lý do rõ ràng và được nêu trong PR/prompt):
- Route: khai báo tại `routes/api.php` hoặc `routes/admin.php` đúng guard.
- FormRequest: tách riêng theo action, ví dụ `StoreXxxRequest`, `UpdateXxxRequest`.
- Controller method: chỉ nhận request, gọi service, trả response.
- Service method: xử lý nghiệp vụ + truy vấn dữ liệu + transaction nếu cần.
- Resource/Collection: chuẩn hóa payload trả về, tránh map tay ở controller.

### 10.2 Quy ước naming
- FormRequest:
  - create: `Store{Domain}Request`
  - update: `Update{Domain}Request`
  - filter/list: `{Domain}IndexRequest` hoặc `List{Domain}Request` (theo pattern hiện có của repo)
- Service:
  - class: `{Domain}Service`
  - method ưu tiên động từ rõ nghĩa: `create`, `update`, `delete`, `toggleStatus`, `getDetail`, `getList`
- Resource:
  - item: `{Domain}Resource`
  - list: `{Domain}Collection` (khi cần custom collection rõ ràng)
- Enum:
  - `{Domain}{Meaning}Enum` (ví dụ status/type/source)

### 10.3 Quy ước transaction
- Bắt buộc dùng transaction trong service khi:
  - ghi từ 2 bảng trở lên
  - ghi DB + thao tác phụ thuộc chặt (attach/detach/sync/update liên quan)
  - có nguy cơ dữ liệu dở dang nếu lỗi giữa chừng
- Không mở transaction trong controller.

### 10.4 Quy ước xử lý lỗi và log
- Mỗi lỗi nghiệp vụ quan trọng cần:
  - message rõ nghĩa cho API consumer
  - error code ổn định để frontend xử lý
  - status code HTTP đúng semantic
- Log cần đủ ngữ cảnh tối thiểu:
  - actor_type (`admin|user|system`)
  - actor_id
  - request_id/correlation_id (nếu có)
  - action/domain
  - input đã được lọc thông tin nhạy cảm
  - exception message + trace (đối với lỗi 5xx)
- Không log dữ liệu nhạy cảm: password, token thô, secret key.

### 10.5 Quy ước mã lỗi (error code)
- Dùng format nhất quán: `{DOMAIN}_{ACTION}_{REASON}`
  - ví dụ: `USER_DELETE_HAS_REQUESTS`, `SERVICE_UPDATE_INVALID_STATUS`
- Không dùng error code mơ hồ kiểu `UNKNOWN_ERROR` cho lỗi nghiệp vụ đã biết.
- Error code phải ổn định theo thời gian; thêm mới thay vì thay đổi nghĩa code cũ.

### 10.6 Quy tắc Enum/hằng số
- Dùng Enum khi:
  - giá trị thuộc domain và có tập giá trị hữu hạn (status, type, channel)
  - cần type-safety/đọc nghĩa rõ trong service/request/resource
- Dùng hằng số class/model khi:
  - giá trị kỹ thuật nội bộ, scope hẹp, không cần Enum full
- Khi đã tạo Enum/hằng số:
  - validate phải tham chiếu cùng nguồn
  - query/service/resource không hard-code chuỗi literal nữa
  - docs/example response đồng bộ theo giá trị chuẩn

## 11) Checklist bắt buộc cho mỗi API task
- [ ] Xác định actor/guard và route group đúng (`admin` vs `user`)
- [ ] Tạo/điều chỉnh `FormRequest` riêng cho action
- [ ] Đưa toàn bộ business logic vào service
- [ ] Dùng `Resource` cho output
- [ ] Chuẩn hóa error response + error code
- [ ] Thêm log context cần thiết, không lộ dữ liệu nhạy cảm
- [ ] Dùng Enum/hằng số cho status/type/code lặp lại
- [ ] Viết/cập nhật test cho happy path + edge/error path
- [ ] Cập nhật docs API khi contract thay đổi

## 12) Mẫu luồng triển khai endpoint mới (tham chiếu nhanh)
1. Tạo route đúng namespace/guard.
2. Tạo `FormRequest` và viết rule/message rõ ràng.
3. Tạo method trong service (kèm transaction nếu cần).
4. Controller gọi service + trả bằng `ResponseHelper` + `Resource`.
5. Gắn exception handling/log/error code theo chuẩn.
6. Viết test:
   - unauthorized/forbidden
   - validation fail
   - success
   - business rule fail
7. Cập nhật Scramble annotation/docs nếu thay đổi contract.

## 13) API docs & tài liệu
- Scramble docs route: `/docs/api`.
- Cấu hình lọc route docs tại `App\Providers\AppServiceProvider::boot()`.
- Tài liệu trong `docs/` có thể mô tả module planned; kiểm tra lại với code runtime trước khi implement.

## 14) Lệnh thường dùng
- Setup: `composer setup`
- Run local: `composer dev`
- Test: `composer test`
- Format:
  - `php artisan code:format --check`
  - `php artisan code:format`

## 15) Bổ sung chuẩn kỹ thuật (đồng bộ từ rule thực chiến)

### 15.1 API contract & HTTP semantics
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

### 15.2 Authentication & Authorization
- Endpoint nhạy cảm bắt buộc gắn middleware auth đúng guard.
- Không tin actor id từ client gửi lên cho hành vi của chính người dùng; ưu tiên lấy từ context đăng nhập.
- Action quan trọng cần check quyền nghiệp vụ rõ ràng (không chỉ check đăng nhập).

### 15.3 Database & query quality
- Mọi thay đổi schema phải đi qua migration.
- Với cột filter/search/join quan trọng, cần đánh giá index phù hợp.
- Tránh N+1 bằng eager loading (`with`) ở endpoint list/detail.
- Soft delete phải xem xét đồng bộ với unique/business rule liên quan.
- Ưu tiên Eloquent (`Model::query()`, local/global scope, relationship query) thay vì viết query builder thuần qua `DB::` nếu không bắt buộc.

### 15.4 Input normalization
- Ngoài validate, cần chuẩn hóa input trước khi xử lý (trim, normalize format khi phù hợp nghiệp vụ).
- Upload bắt buộc kiểm tra mime/type/size theo cấu hình.

### 15.5 Upload & media convention
- Tên file lưu trữ phải an toàn, không phụ thuộc trực tiếp tên gốc từ client.
- Quy tắc crop/resize/encode cần cấu hình hóa, không hard-code trong controller.
- Metadata ảnh tối thiểu cần truy vết được owner/type/path.

### 15.6 Config & environment
- Tuyệt đối không hard-code secret trong source; dùng `.env`.
- Mọi biến cấu hình nên có default hợp lý trong `config/*` khi có thể.
- Khi thêm config quan trọng, cập nhật `.env.example` để onboarding môi trường mới.

### 15.7 Code style & maintainability
- Tuân thủ PSR-12 và chuẩn format của project.
- Ưu tiên method ngắn, dễ đọc, early return; hạn chế nested condition sâu.
- Tách method nhỏ khi logic bắt đầu phình to hoặc trùng lặp.
- Comment chỉ dùng khi logic khó hiểu; nếu có comment trong code, bắt buộc English.

### 15.8 Quality gate & review gate
- Endpoint quan trọng cần có feature test cho các nhánh:
  - success
  - invalid input
  - unauthorized/forbidden
  - not found
  - business conflict
- Service có nghiệp vụ phức tạp cần unit test cho logic lõi.
- Trước khi kết thúc task phải tự soát:
  - đúng nghiệp vụ
  - không phá API contract
  - có validation + error handling + logging
  - không lộ dữ liệu nhạy cảm
  - test/verify đã chạy theo phạm vi thay đổi

### 15.9 Nguyên tắc kiến trúc và tương thích
- Ưu tiên clean code, SOLID, DRY, KISS, convention over configuration.
- Không tự ý đổi kiến trúc khi chưa nêu rõ lý do và được user xác nhận.
- Mặc định giữ backward compatibility; chỉ thực hiện breaking change khi user yêu cầu rõ.
- Nếu yêu cầu mơ hồ hoặc có nhiều cách hiểu, phải làm rõ trước khi code.

## 16) Agent skill vận hành nội bộ (áp dụng mặc định cho mọi task code)
1. **Scope skill**
   - Xác định rõ in-scope/out-of-scope trước khi chạm code.
   - Nếu yêu cầu mơ hồ, chốt assumption ngắn gọn trước khi triển khai.
2. **Architecture skill**
   - Ép luồng chuẩn `Route -> FormRequest -> Controller -> Service -> Resource -> ResponseHelper`.
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
   - Mỗi task đều phải verify tối thiểu: format/lint liên quan + test hoặc checklist theo mức độ thay đổi.
   - Chỉ coi là hoàn tất khi pass DoD của file này.
7. **Model generation skill**
   - Khi tạo model mới, mặc định tạo kèm Factory + Seeder để hỗ trợ test và seed dữ liệu.
   - Trước khi generate model, hỏi user có cần thêm thành phần khác không (migration, controller, request, policy, resource, v.v.) dựa trên option khả dụng của `php artisan make:model`.
   - Khi cần liệt kê option, kiểm tra bằng command tương đương `list-artisan-commands`/`php artisan make:model --help`.
8. **Task closure skill**
   - Khi chốt task, ưu tiên format báo cáo: (1) Thay đổi chính (2) File đã sửa (3) Lý do thiết kế (4) Cách verify (5) Rủi ro còn lại.

## 17) Local skill files (đã tạo trong repo)
- `.cursor/skills/api-task-execution/SKILL.md`
- `.cursor/skills/api-error-logging/SKILL.md`
- `.cursor/skills/api-test-verify-gate/SKILL.md`
- `.cursor/skills/README.md`

Thứ tự áp dụng khuyến nghị:
1. `api-task-execution`
2. `api-error-logging`
3. `api-test-verify-gate`
