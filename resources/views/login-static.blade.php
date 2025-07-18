<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول</title>
    <style>
        body {
            font-family: Tahoma, Arial, sans-serif;
            background: #f7f7f7;
            text-align: center;
            padding-top: 60px;
        }

        .box {
            background: #fff;
            margin: auto;
            padding: 30px 20px;
            border-radius: 10px;
            box-shadow: 0 2px 8px #ddd;
            max-width: 400px;
        }

        .title {
            font-size: 1.5em;
            margin-bottom: 20px;
            color: #3498db;
        }

        .input {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1em;
        }

        .btn {
            width: 100%;
            padding: 10px;
            background: #3498db;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 1.1em;
            margin-top: 15px;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn:hover {
            background: #217dbb;
        }

        .note {
            color: #888;
            margin-top: 20px;
            font-size: 0.95em;
        }
    </style>
</head>

<body>
    <div class="box">
        <div class="title">تسجيل الدخول</div>
        <form>
            <input type="email" class="input" placeholder="البريد الإلكتروني" disabled>
            <input type="password" class="input" placeholder="كلمة المرور" disabled>
            <button type="button" class="btn" disabled>دخول</button>
        </form>
        <div class="note">هذه الصفحة للعرض فقط (واجهة تجريبية).</div>
    </div>
</body>

</html>