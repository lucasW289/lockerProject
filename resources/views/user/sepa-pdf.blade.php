
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SEPA Form</title>
    <style>
        /* Your CSS styles for the PDF */
        body {
            font-family: DejaVu Sans, sans-serif;
        }
    </style>
</head>
<body>
    <h1>SEPA Form</h1>
    <table>
        <tr>
            <th>Full Name</th>
            <td>{{ $full_name }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $email }}</td>
        </tr>
        <tr>
            <th>IBAN</th>
            <td>{{ $iban }}</td>
        </tr>
        <tr>
            <th>BIC</th>
            <td>{{ $bic }}</td>
        </tr>
    </table>
</body>
</html>
