# UI Login Implementation Plan

## Mục tiêu
Tạo một form đăng nhập (login) hiện đại, thân thiện với người dùng, responsive trên nhiều thiết bị, và đảm bảo kiểm thử tự động với Playwright.

## Các Logic Cần Thực Hiện

1. **Thiết kế UI**
   - Tạo layout đăng nhập.
   - Bao gồm các input: email/username, password.
   - Thêm nút "Đăng nhập" và checkbox "Ghi nhớ đăng nhập".
   - Thiết kế responsive cho mobile, tablet, desktop.
   - Tối ưu UX (trạng thái hover, focus, disabled).

2. **Logic Frontend**
   - Xử lý sự kiện submit form.
   - Hiển thị thông báo lỗi nếu nhập sai (ví dụ: email trống, mật khẩu sai).
   - Ẩn password khi nhập.
   - Thêm loading state khi submit.

3. **Validation UX/UI**
   - Validate UI layout trên các kích cỡ màn hình.
   - Kiểm tra không có overflow hay clipping.
   - Đảm bảo tất cả các phần tử quan trọng đều visible.
   - Kiểm thử tương tác (click, focus, hover, modals).
   - Kiểm thử accessibility: tab, focus, aria labels.

4. **Cài đặt Playwright**
   - Kiểm tra Playwright đã cài chưa.
   - Nếu chưa, tự động cài đặt Playwright và các browser (Chromium, Chrome).
   - Viết test case Playwright cho UX/UI (responsive, interaction, console errors).
   - Thực thi test tự động sau khi UI được tạo.

5. **Session Persistence**
   - Sau khi login, reload trang và kiểm tra user vẫn được giữ đăng nhập.
   - Kiểm tra cookie/session có tồn tại.

6. **Đưa vào CI/CD**
   - Đưa test Playwright vào pipeline CI/CD để tự động kiểm tra mỗi lần deploy.

## Checklist

- [ ] UI login thiết kế hoàn thiện.
- [ ] Responsive trên mobile, tablet, desktop.
- [ ] Kiểm thử tất cả các tương tác (submit, focus, hover).
- [ ] Playwright test chạy tự động.
- [ ] Kiểm tra session sau reload.
- [ ] CI/CD pipeline hoàn thiện.