<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mission Report</title>
</head>
<body>
    <h1>Mission Report</h1>

    <h2>Classified information from Mission Control for captain {{ $mission -> captain }}</h2>

    <ul>
        <li>Destination: {{ $mission -> destination -> name }}</li>
        <li>Success: {{ $mission -> success ? "YES" : "NO" }}</li>
        <li>Report: {{ $mission -> report }}</li>
    </ul>
</body>
</html>
