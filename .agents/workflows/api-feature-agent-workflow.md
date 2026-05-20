# API Feature Agent Workflow

## Muc Dich

Day la workflow de giao mot chuc nang API cho agent khac thuc hien. Tai lieu nay tap trung vao yeu cau can lam, khong lap lai coding convention chi tiet.

## Cach Dien Brief

Khi muon tao mot API moi hoac sua API cu, dien cac muc sau:

```text
Ten chuc nang:
Actor/nguoi dung:
Muc tieu:
Endpoint mong muon:
Input:
Output:
Business rules:
Phan quyen:
Lien ket du lieu:
Case loi:
Khong lam:
Kiem thu mong muon:
```

## Thong Tin Can Cung Cap

### 1. Ten Chuc Nang

Mo ta ngan gon API can lam.

Vi du:

```text
Admin tao category
User gui request bao gia
User lay danh sach service public
```

### 2. Actor/Nguoi Dung

Xac dinh ai duoc dung API:

- Guest
- User da dang nhap
- Admin da dang nhap
- System/job

### 3. Muc Tieu

Mo ta ket qua nghiep vu sau khi API chay thanh cong.

Vi du:

```text
Admin co the tao category moi voi trang thai draft hoac public.
User chi nhin thay service co trang thai public.
```

### 4. Endpoint Mong Muon

Neu da biet endpoint thi ghi ro. Neu chua biet, agent duoc phep de xuat theo convention repo.

Vi du:

```text
GET /api/services
POST /admin/categories
GET /admin/users/{id}
```

### 5. Input

Liet ke field client gui len.

Vi du:

| Field | Type | Required | Ghi Chu |
| --- | --- | --- | --- |
| `name` | string | Co | Ten category |
| `status` | string | Co | `public` hoac `draft` |
| `image` | file | Khong | Anh dai dien |

### 6. Output

Mo ta data client can nhan.

Vi du:

```text
Tra ve id, name, status, created_at.
Neu la list thi can pagination.
```

Khong can ghi qua chi tiet format ky thuat neu repo da co response convention.

### 7. Business Rules

Ghi cac rule nghiep vu bat buoc.

Vi du:

- Ten category khong duoc trung.
- Chi tra service public cho user.
- Khong xoa user neu user da co request lien quan.
- Zipcode phai co 7 so.

### 8. Phan Quyen

Ghi rule truy cap.

Vi du:

- Guest khong duoc dung.
- User chi xem/sua du lieu cua chinh minh.
- Admin duoc quan ly tat ca user.

### 9. Lien Ket Du Lieu

Ghi cac bang/model lien quan neu biet.

Vi du:

```text
categories
services
requests
images
users
```

Neu co quan he can bao ve khi xoa/sua, ghi ro.

### 10. Case Loi

Liet ke cac tinh huong can xu ly:

- Thieu input.
- Sai format.
- Khong co quyen.
- Khong tim thay record.
- Du lieu bi trung.
- Bi chan do business rule.

### 11. Khong Lam

Ghi ro nhung gi khong nam trong scope.

Vi du:

```text
Khong lam UI admin.
Khong lam bulk delete.
Khong gui email trong task nay.
```

### 12. Kiem Thu Mong Muon

Liet ke case can agent test/verify:

- Success path.
- Validation fail.
- Unauthorized/forbidden.
- Not found.
- Business rule fail.

## Template San De Dung

```markdown
# API Brief: <ten-chuc-nang>

## Muc Tieu
<mo ta can dat duoc>

## Actor
<guest|user|admin|system>

## Endpoint
<method + path neu da biet, hoac "agent de xuat">

## Input
| Field | Type | Required | Ghi Chu |
| --- | --- | --- | --- |
| | | | |

## Output Mong Muon
<du lieu client can nhan>

## Business Rules
-

## Phan Quyen
-

## Case Loi Can Xu Ly
-

## Khong Lam
-

## Kiem Thu
-
```

## Bao Cao Cuoi Task

Agent can bao cao:

1. API da tao/sua.
2. Input/output thuc te.
3. Business rules da implement.
4. Case loi da xu ly.
5. Test/verify da chay.
6. Rui ro con lai.
