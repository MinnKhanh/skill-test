# Auth Completion Agent Workflow

## Muc Dich

Day la brief chuc nang cho agent khac doc va trien khai tiep module auth. Tai lieu nay chi mo ta can lam gi va ket qua mong muon. Cac quy tac ky thuat chi tiet, coding convention, test gate va kien truc chuan se lay theo repo hien tai.

## Boi Canh

Project da co mot phan dang nhap. Agent can doc code hien co truoc, giu lai flow dang nhap dang chay tot, sau do hoan thien nhung phan con thieu.

## Muc Tieu Chinh

1. Hoan thien va cai thien giao dien dang nhap hien co.
2. Them giao dien va xu ly dang ky tai khoan.
3. Them chuc nang quen mat khau.
4. Them chuc nang dat lai mat khau.
5. Dang ky phai co Google reCAPTCHA.
6. Dang ky co anh dai dien.
7. Khong lam hong flow dang nhap hien tai.

## Yeu Cau Dang Nhap

Dang nhap hien da co, can:

- Kiem tra flow hien tai dang dung field nao de dang nhap.
- Giu tuong thich voi tai khoan cu.
- Cai thien UI de form ro rang, de nhap, hien thi loi validation tot.
- Bo sung link sang dang ky va quen mat khau.
- Neu dang nhap sai, hien thi thong bao an toan, khong tiet lo thong tin nhay cam.

## Yeu Cau Dang Ky

Form dang ky gom:

| Field | Mo Ta | Bat Buoc |
| --- | --- | --- |
| `first_name` | Ten | Co |
| `last_name` | Ho | Co |
| `username` | Ten dang nhap | Co, khong trung |
| `password` | Mat khau | Co |
| `password_confirmation` | Xac nhan mat khau | Co |
| `gender` | Gioi tinh | Tuy rule hien co |
| `address` | Dia chi | Tuy rule hien co |
| `occupation` | Nghe nghiep | Tuy rule hien co |
| `avatar` | Anh dai dien | Khong bat buoc neu khong co rule khac |
| `g-recaptcha-response` | Token reCAPTCHA | Co |

Ket qua mong muon:

- Dang ky thanh cong tao duoc user moi.
- Ten dang nhap khong duoc trung.
- Mat khau duoc validate theo rule hien co cua project.
- Neu co anh dai dien thi luu theo convention upload hien tai.
- Sau khi dang ky thanh cong, redirect ve trang phu hop va hien thong bao thanh cong.

## Yeu Cau reCAPTCHA

- Dang ky phai verify Google reCAPTCHA truoc khi tao user.
- Khong tu y truy cap tai khoan Google cua user de lay key.
- Key phai duoc cau hinh qua environment.
- Neu chua co key, agent can bo sung huong dan setup ro rang.
- Khi verify that bai, form phai hien loi de nguoi dung biet can thu lai.

## Yeu Cau Quen Mat Khau

Can co flow:

1. Nguoi dung mo trang quen mat khau.
2. Nguoi dung nhap email hoac thong tin dinh danh theo flow hien co.
3. He thong gui huong dan dat lai mat khau.
4. Thong bao tra ve phai an toan, khong tiet lo tai khoan co ton tai hay khong.

Ket qua mong muon:

- Gui duoc mail reset neu cau hinh mail hop le.
- Neu mail chua cau hinh, agent phai ghi ro cach setup/verify.
- Khong log token reset password.

## Yeu Cau Dat Lai Mat Khau

Can co flow:

1. Nguoi dung mo link reset password.
2. Nguoi dung nhap mat khau moi va xac nhan mat khau.
3. He thong validate token va mat khau moi.
4. Neu hop le, cap nhat mat khau.
5. Sau khi thanh cong, dua nguoi dung ve trang dang nhap va hien thong bao.

Can xu ly:

- Link het han.
- Token khong hop le.
- Mat khau khong dat yeu cau.
- Xac nhan mat khau khong khop.

## Yeu Cau UI

Can co cac man hinh:

- Login
- Register
- Forgot password
- Reset password

UI mong muon:

- Dong bo style giua cac man hinh auth.
- Responsive tren mobile va desktop.
- Form de doc, label ro rang, nut bam de nhan biet.
- Loi validation hien thi gan field lien quan.
- Co dieu huong qua lai giua login/register/forgot password.
- Khong de text bi tran, bi che, hoac layout bi vo.

## Du Lieu Va Schema

Agent can kiem tra schema hien tai truoc khi sua.

Neu user table chua co cac field dang ky can thiet thi bo sung theo cach khong pha du lieu cu:

- `first_name`
- `last_name`
- `username`
- `gender`
- `address`
- `occupation`

Khong xoa hoac doi nghia field cu neu khong duoc yeu cau.

## Bao Mat

- Khong log password.
- Khong log token reset password.
- Khong log reCAPTCHA secret.
- Khong hien stack trace cho nguoi dung.
- Thong bao loi auth phai an toan.
- Nen co rate limit cho login va quen mat khau neu project chua co.

## Kiem Thu Can Co

Toi thieu can verify:

- Login cu van hoat dong.
- Register thanh cong.
- Register fail khi thieu field bat buoc.
- Register fail khi username trung.
- Register fail khi reCAPTCHA khong hop le.
- Forgot password tra thong bao an toan.
- Reset password thanh cong.
- Reset password fail khi token sai/het han.
- UI auth khong bi vo tren mobile va desktop.

## Tieu Chi Hoan Thanh

- Login hien co khong bi regression.
- Register day du field theo yeu cau.
- reCAPTCHA duoc tich hop vao dang ky.
- Forgot password va reset password dung duoc.
- Avatar dang ky duoc xu ly dung convention hien co hoac neu chua lam duoc thi neu ro ly do.
- UI auth dong bo, de dung, responsive.
- Co cap nhat setup note cho reCAPTCHA va mail neu can.
- Co bao cao cach verify va rui ro con lai.

## Bao Cao Cuoi Task

Agent can bao cao:

1. Da hoan thien nhung flow nao.
2. Cac man hinh da them/sua.
3. Cac field/schema da them neu co.
4. Cach setup reCAPTCHA va mail.
5. Cac case da test/verify.
6. Rui ro con lai hoac viec can user cau hinh them.
