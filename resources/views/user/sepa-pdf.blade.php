<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SEPA Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <h1>SEPA Form</h1>
    <div class="form-group">
        <label>Full Name:</label>
        <p>{{ $full_name }}</p>
    </div>
    <div class="form-group">
        <label>Email:</label>
        <p>{{ $email }}</p>
    </div>
    <div class="form-group">
        <label>IBAN:</label>
        <p>{{ $iban }}</p>
    </div>
    <div class="form-group">
        <label>BIC:</label>
        <p>{{ $bic }}</p>
    </div>
</body>
</html>
