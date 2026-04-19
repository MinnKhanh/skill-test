# Mandatory Coding Rules

## 1) Scope

Tai lieu nay la bo rule bat buoc ap dung cho moi task coding trong du an API Laravel.

## 2) Mandatory Rules

1. Khong bat dau code khi requirement mo ho; phai clarify truoc.
2. Khong dat business logic phuc tap trong Controller.
3. Tat ca endpoint ghi du lieu bat buoc dung FormRequest validation.
4. Khong hard-code business values; dua vao `config`, `enum`, `const`.
5. Moi thay doi schema bat buoc qua migration, rollback duoc.
6. Nghiep vu ghi nhieu bang bat buoc dung transaction.
7. Response API phai theo contract thong nhat cua du an.
8. Khong expose stacktrace/noi bo he thong ra client.
9. Khong log password, token, secret, payload nhay cam.
10. Auth va permission phai check dung guard/actor context.
11. Khong tao breaking change API neu chua danh gia impact/versioning.
12. Moi task phai co verify steps truoc khi ket thuc.

## 3) Code Quality Rules

1. Tuan thu convention style cua repo (PSR-12 + convention noi bo).
2. Method ngan, ro nghia, uu tien early return.
3. Han che nested if sau; tach method khi can.
4. Tranh duplicate logic; uu tien tai su dung.
5. Comment chi viet khi can thiet; comment code bat buoc bang English.

## 4) Definition of Done

Task chi duoc xem la Done khi:

- [ ] Dung requirement da chot
- [ ] Dung mandatory rules o tren
- [ ] Da verify success + error paths
- [ ] Khong vo contract API ngoai y muon
- [ ] Co huong dan test/verify ro rang cho reviewer/QA
