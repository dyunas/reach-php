<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Password Reset</title>
</head>

<body>
  <h4>Hi {{ $user }}!</h4>
  <p>
    We have resetted your password for you. You can now login to your account using the new password generated
    by our system.
    We strongly recommend to change your password immediately.
  </p>

  <table>
    <tbody>
      <td><strong>New Password:</strong></td>
      <td>{{ $pword }}</td>
    </tbody>
  </table>
</body>

</html>