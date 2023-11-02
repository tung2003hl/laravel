
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Change Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            display: block;
        }

        input[type="password"] {
            width: 90%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .btn-change {
            background-color: #007BFF;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-change:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <a style="text-decoration:none;" class="btn btn-link text-black ml-2 mt-0" href="{{route('profile.detail')}}"><- Profile</a>
    <div class="container">
        <h2>Change Password</h2>
        <form action="{{route('change.password')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="current_password">Current Password:</label>
                <input type="password" id="current_password" name="current_password" placeholder="Current Password" required>
                @error('current_password')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="newPassword">New Password:</label>
                <input type="password" id="new_password" name="new_password" placeholder="New Password" required>
                @error('new_password')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="confirmPassword">Confirm New Password:</label>
                <input type="password" id="new_password_confirmation" name="new_password_confirmation" placeholder="Confirm New Password" required>
                @error('new_password_confirmation')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <button type="submit" class="btn-change">Change Password</button>
            </div>
        </form>
    </div>
</body>
</html>
