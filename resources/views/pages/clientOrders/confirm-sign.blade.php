{{-- resources/views/contracts/success.blade.php --}}
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contract Signed</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .card {
            background: #fff;
            border-radius: 20px;
            padding: 40px;
            text-align: center;
            max-width: 450px;
            width: 100%;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        .logo {
            height: 80px;
            width: 400px;
            margin-bottom: 25px;
        }
        .icon-wrapper {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #ffd200;
            border-radius: 50%;
            width: 80px;
            height: 80px;
            margin-bottom: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.15);
        }
        .icon-wrapper svg {
            width: 45px;
            height: 45px;
            color: black;
        }
        h2 {
            font-size: 24px;
            font-weight: 700;
            color: #333;
            margin-bottom: 10px;
        }
        p {
            color: #666;
            font-size: 15px;
            margin-bottom: 30px;
        }
        .btn {
            display: inline-block;
            padding: 14px 28px;
            background: #ffd200;
            color: black;
            font-weight: 600;
            text-decoration: none;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        .btn:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>

<div class="card">
    {{-- Company Logo --}}
    <img src="{{ asset('images/logo-2.png') }}" alt="Company Logo" class="logo">

    {{-- Success Icon --}}
    <div class="icon-wrapper">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M5 13l4 4L19 7" />
        </svg>
    </div>

    {{-- Success Message --}}
    <h2>Contract Signed Successfully</h2>
    <p>Thank you for completing the process. Your contract has been signed and recorded correctly.</p>

    {{-- Back Button --}}
    <a href="{{ route('home') }}" class="btn">Confirm & Complete Process</a>
</div>

</body>
</html>
