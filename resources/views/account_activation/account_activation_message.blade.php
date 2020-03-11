<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Reach Account Activation</title>
</head>

<body>
  <h4>Hi {{ $user }}!</h4>
  <p>
    Congratulations! Your account is now activated. Welcome! Thank you for choosing REACH as your business partner!
  </p>

  <table>
    <thead>
      <tr>
        <th colspan="2">Account Details</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><strong>Username:</strong></td>
        <td>{{ $email }}</td>
      </tr>
      <tr>
        <td><strong>Password:</strong></td>
        <td>{{ $pword }}</td>
      </tr>
    </tbody>
  </table>
</body>

</html>