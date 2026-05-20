# UI Feature Agent Workflow

## Muc Dich

Day la workflow de giao viec cat giao dien hoac trien khai mot chuc nang UI cho agent khac. Tai lieu nay tap trung vao man hinh can lam, hanh vi nguoi dung, state, validation va tieu chi hoan thanh.

## Cach Dien Brief

Khi muon cat mot giao dien/chuc nang UI, dien cac muc sau:

```text
Ten man hinh/chuc nang:
Nguoi dung:
Muc tieu:
Duong dan/page:
Data hien thi:
Form/input:
Hanh dong:
Trang thai:
Responsive:
Lien ket API:
Khong lam:
Kiem thu mong muon:
```

## Thong Tin Can Cung Cap

### 1. Ten Man Hinh/Chuc Nang

Vi du:

```text
Login page
Register page
Admin user list
Service detail page
Request create form
```

### 2. Nguoi Dung

Ai se dung man hinh nay:

- Guest
- User
- Admin

### 3. Muc Tieu

Mo ta nguoi dung hoan thanh duoc viec gi.

Vi du:

```text
Guest co the dang ky tai khoan moi.
Admin co the xem, tim kiem va cap nhat user.
User co the gui request bao gia.
```

### 4. Duong Dan/Page

Ghi route/page neu da biet.

Vi du:

```text
/login
/register
/admin/users
/services/{id}
```

Neu chua biet, agent co the de xuat theo convention hien co.

### 5. Data Hien Thi

Liet ke thong tin can hien thi.

Vi du:

- Ten user.
- Email.
- Trang thai.
- Anh dai dien.
- Ngay tao.

### 6. Form/Input

Neu co form, liet ke field:

| Field | Loai UI | Required | Ghi Chu |
| --- | --- | --- | --- |
| `name` | text input | Co | |
| `status` | select | Co | public/draft |
| `avatar` | file input | Khong | preview anh |

### 7. Hanh Dong

Liet ke action nguoi dung co the lam:

- Submit form.
- Search.
- Filter.
- Sort.
- Pagination.
- Upload image.
- Delete.
- Toggle status.
- Cancel/back.

### 8. Trang Thai UI

Can xu ly cac state:

- Loading.
- Empty.
- Success.
- Validation error.
- Permission denied.
- Not found.
- Server error.

### 9. Responsive

Ghi yeu cau responsive:

- Mobile.
- Tablet.
- Desktop.
- Bang/table co can scroll ngang hay chuyen sang card.
- Form co can chia cot tren desktop hay khong.

### 10. Lien Ket API

Neu UI goi API, ghi ro API can dung neu da biet:

```text
GET /admin/users
POST /api/auth/register
POST /api/upload-image
```

Neu API chua co, agent can bao lai can tao API truoc hay mock tam.

### 11. Khong Lam

Ghi ro pham vi khong lam.

Vi du:

```text
Khong lam backend.
Khong lam export CSV.
Khong lam bulk action.
Khong sua layout toan app.
```

### 12. Kiem Thu Mong Muon

Can verify:

- Man hinh render dung.
- Form submit duoc.
- Validation error hien dung.
- Loading/empty/error state co hien.
- Responsive khong vo layout.
- Khong co loi console nghiem trong.

## Template San De Dung

```markdown
# UI Brief: <ten-man-hinh>

## Muc Tieu
<nguoi dung can lam duoc gi>

## Nguoi Dung
<guest|user|admin>

## Page/Route
<duong dan neu da biet>

## Data Hien Thi
-

## Form/Input
| Field | Loai UI | Required | Ghi Chu |
| --- | --- | --- | --- |
| | | | |

## Hanh Dong
-

## Trang Thai UI
- Loading:
- Empty:
- Success:
- Error:

## Responsive
-

## API Lien Quan
-

## Khong Lam
-

## Kiem Thu
-
```

## Bao Cao Cuoi Task

Agent can bao cao:

1. Man hinh/chuc nang da hoan thien.
2. Component/view/file da tao hoac sua.
3. State va validation da xu ly.
4. API da ket noi hoac dang mock.
5. Ket qua test UI/responsive.
6. Rui ro con lai.
