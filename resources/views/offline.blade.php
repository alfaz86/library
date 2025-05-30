<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Offline</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f7f9fa;
            color: #333;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }

        .container {
            max-width: 500px;
            padding: 2rem;
        }

        .icon {
            width: 120px;
            height: 120px;
        }

        h1 {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        p {
            font-size: 1rem;
            color: #666;
        }

        .retry-button {
            margin-top: 2rem;
            padding: 10px 20px;
            color: #333;
            background-color: #FFF;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-weight: 600;
            border: 1px solid #999;
        }

        .retry-button:hover {
            background-color: #E0E0E0;
        }
    </style>
</head>
<body>
    <div class="container">
        <img class="icon" src="{{ asset('images/no-internet.png') }}" alt="No Internet Icon">
        <h1>{{ __('offline.header') }}</h1>
        <p style="padding: 0px; margin: 0px;">{{ __('offline.text.part1') }}</p>
        <p style="padding: 0px; margin: 0px;">{{ __('offline.text.part2') }}</p>

        <button class="retry-button" onclick="window.location.reload();">{{ __('offline.retry') }}</button>
    </div>
</body>
</html>
