<!DOCTYPE html>
<html>
<head>
    <title>Quên mật khẩu</title>
</head>
<body>
    <div style="max-width: 400px; margin: 40px auto; background: #fff; border-radius: 20px; box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15); padding: 40px;">
        <div style="display: flex; gap: 24px; margin-bottom: 32px;">
            <a href="{{ route('login') }}" style="flex:1; text-align:center; padding:12px 0; border-radius:10px; background:#fff; color:#888; text-decoration:none; font-weight:600; border: none;">Login</a>
            <span style="flex:1; text-align:center; padding:12px 0; border-radius:10px; background:#0d47a1; color:#fff; font-weight:600; border: none;">Forgot Password</span>
        </div>
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div style="margin-bottom: 20px;">
                <label for="email" style="display:block; margin-bottom:8px; color:#444; font-weight:500;">Email address</label>
                <input type="email" id="email" name="email" required autofocus style="width:100%; padding:12px; border-radius:8px; border:1px solid #e0e0e0; font-size:16px;">
            </div>
            <div style="margin-bottom: 28px; text-align:right;">
                <a href="{{ route('login') }}" style="color:#1565c0; text-decoration:none; font-size:14px;">Back to Login?</a>
            </div>
            <button type="submit" style="width:100%; padding:14px 0; border:none; border-radius:10px; background: linear-gradient(90deg, #0d47a1 0%, #1976d2 100%); color:#fff; font-size:18px; font-weight:600; cursor:pointer;">
                Send Password Reset Link
            </button>
        </form>
    </div>
</body>
</html>
