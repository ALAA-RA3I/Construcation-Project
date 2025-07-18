<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تفعيل الحساب</title>
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

        .success {
            color: #27ae60;
            font-size: 1.3em;
        }

        .fail {
            color: #c0392b;
            font-size: 1.2em;
        }

        .btn {
            display: inline-block;
            margin-top: 25px;
            padding: 10px 30px;
            background: #3498db;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
            font-size: 1.1em;
            transition: background 0.2s;
        }

        .btn:hover {
            background: #217dbb;
        }

        .contract-link {
            display: block;
            margin-top: 20px;
            color: #2c3e50;
            font-size: 1.1em;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="box">
        @if($success)
        <div class="success">{!! $message !!}</div>
        @if(!empty($contract_url))
        <a href="{{ $contract_url }}" class="contract-link" target="_blank">عرض العقد (PDF)</a>
        @endif
        <a href="/login-static" class="btn">تسجيل الدخول</a>
        @else
        <div class="fail">{{ $message }}</div>
        @endif
    </div>
</body>

</html>