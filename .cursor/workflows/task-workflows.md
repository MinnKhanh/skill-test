# Task Workflows (API Laravel)

## 1) Workflow Tao API Moi

1. Chot requirement:
   - actor, endpoint, method, input/output, error cases, business rules.
2. Tao route + middleware:
   - auth/permission/rate limit.
3. Tao FormRequest:
   - `authorize()` + `rules()` + normalize input neu can.
4. Implement service logic:
   - transaction neu multi-write, throw domain exception khi can.
5. Implement controller:
   - nhan request, goi service, tra response dung contract.
6. Cap nhat model/relation/scope neu can.
7. Map exception => HTTP response chuan.
8. Test:
   - success, validation fail, unauthorized/forbidden, not found, business conflict.
9. Cap nhat API doc.

Done checklist:
- [ ] Route/middleware dung
- [ ] Validation day du
- [ ] Permission dung
- [ ] Response contract dung
- [ ] Test/verify xong

---

## 2) Workflow Tao Enum

1. Xac dinh domain cua enum:
   - status, type, mode, source...
2. Dat ten enum theo domain ro rang.
3. Khai bao value on dinh:
   - uu tien int/string co y nghia nghiep vu, tranh value mo ho.
4. Them helper method (neu can):
   - label(), values(), isValid() hoac mapping dung chung.
5. Replace magic number/string trong code hien co bang enum.
6. Cap nhat validation de chap nhan values cua enum.
7. Cap nhat seed/doc/test lien quan.

Done checklist:
- [ ] Khong con magic value trong flow moi
- [ ] Validation dung enum values
- [ ] Khong pha vo du lieu cu

---

## 3) Workflow Tao FormRequest

1. Tao request class theo ten action ro nghia.
2. Implement `authorize()` theo rule permission.
3. Implement `rules()`:
   - type + format + business constraints.
4. Them message/attributes localization neu can.
5. Normalize input trong `prepareForValidation()` neu can.
6. Gan request vao controller action.
7. Verify loi 422 theo response contract.

Done checklist:
- [ ] Rules day du cho field ghi du lieu
- [ ] Authorize dung ngu canh
- [ ] Error message dung va de hieu

---

## 4) Workflow Tao Migration/Schema Change

1. Chot impact schema + backward compatibility.
2. Tao migration:
   - ten migration ro muc dich.
3. Dinh nghia column/FK/index dung nhu cau query.
4. Viet `down()` rollback duoc.
5. Cap nhat model casts/relations neu can.
6. Chay migrate + verify query path.
7. Cap nhat release note neu la breaking/risky.

Done checklist:
- [ ] Migrate/rollback OK
- [ ] Index/FK du
- [ ] Khong gay lock/risk lon ngoai du kien

---

## 5) Workflow Tao Feature Co Transaction

1. Xac dinh boundary atomic (bat dau-ket thuc nghiep vu).
2. Validate input truoc transaction.
3. Thuc hien DB writes trong transaction block.
4. Throw exception de rollback khi loi.
5. Side effects (mail/notify) uu tien sau commit.
6. Log context khi fail.

Done checklist:
- [ ] Khong partial data neu loi
- [ ] Rollback verified
- [ ] Side effects khong bi duplicate khong kiem soat

---

## 6) Workflow Tao Job/Queue

1. Xac dinh job nen async hay sync.
2. Tao job class voi payload toi gian.
3. Cau hinh `tries`, `backoff`, `timeout`.
4. Dam bao idempotent neu co retry.
5. Dispatch dung thoi diem (`afterCommit` neu can).
6. Theo doi failed jobs + logging.

Done checklist:
- [ ] Retry policy ro rang
- [ ] Failure handling co
- [ ] Khong duplicate side effect nguy hiem

---

## 7) Workflow Tao Mail Feature

1. Chot trigger gui mail + danh sach recipient.
2. Tao/Cap nhat Mailable class.
3. Tao template email ro placeholder.
4. Queue mail neu khong can blocking response.
5. Xu ly fallback khi thieu optional data.
6. Verify noi dung, nguoi nhan, duplicate send.

Done checklist:
- [ ] Subject/body dung nghiep vu
- [ ] Recipient dung rule
- [ ] Queue/failure behavior duoc kiem soat

---

## 8) Workflow Sua API Dang Co

1. Phan tich contract diff.
2. Xac dinh co breaking change hay khong.
3. Neu breaking: de xuat versioning/deprecation.
4. Implement thay doi + giu compatibility toi da.
5. Them regression tests.
6. Cap nhat doc impact.

Done checklist:
- [ ] Client cu khong vo ngoai du kien
- [ ] Contract moi ro rang
- [ ] Regression da verify
