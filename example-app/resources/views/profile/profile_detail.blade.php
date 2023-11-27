<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/transaction_history.css') }}">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
    
        .profile-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 2px solid #ccc;
            border-radius: 5px;
            text-align: center;
            position: relative;
        }
    
        .profile-title {
            font-size: 28px;
            position: absolute;
            top: -20px; /* Đặt khoảng cách 30px phía trên */
            left: 50%;
            transform: translateX(-50%);
            display: inline-block; /* Hiển thị chữ "Profile" trên cùng một dòng */
            padding: 10px 20px; /* Khoảng cách xung quanh chữ "Profile" */
            border: 2px solid #ccc; /* Khung xung quanh chữ "Profile" */
            border-radius: 5px; /* Bo tròn các góc của khung */
        }
    
        .btn-change-password {
            position: absolute;
            bottom: 33px; /* Đặt nút "Change Password" phía trên */
            right: 20px;
            text-decoration: none;
            background-color: #007BFF;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
        }
    
        .form-group {
            margin-bottom: 20px;
            text-align: left; /* Căn trái cho label và input */
        }
    
        label {
            font-weight: bold;
            display: block;
        }
    
        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
    
        .btn-save {
            background-color: #007BFF;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    
        .btn-save:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    @extends(Auth::user()->type == 0 ? 'layouts.app' : 'layouts.app1')
    @section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-3 my-lg-0 my-md-1">
                <div id="sidebar" class="bg-purple">
                    <div class="h4 text-white">Account</div>
                    <ul>
                        <li class=""{{ request()->routeIs('show.profile') ? 'active' : '' }}"">
                            <a href="{{route('show.profile')}}" class="text-decoration-none d-flex align-items-start">
                                <div class="fas fa-box pt-2 me-3"></div>
                                <div class="d-flex flex-column">
                                    <div class="link">My Account</div>
                                    <div class="link-desc">View & Manage orders and returns</div>
                                </div>
                            </a>
                        </li>
                        <li class="active">
                            <a href="{{route('profile.detail')}}" class="text-decoration-none d-flex align-items-start">
                                <div class="far fa-user pt-2 me-3"></div>
                                <div class="d-flex flex-column">
                                    <div class="link">My Profile</div>
                                    <div class="link-desc">Change your profile details & password</div> 
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-decoration-none d-flex align-items-start">
                                <div class="fas fa-headset pt-2 me-3"></div>
                                <div class="d-flex flex-column">
                                    <div class="link">Help & Support</div>
                                    <div class="link-desc">Contact Us for help and support</div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9 my-lg-0 my-1">
                <div class="profile-container">
                    <h1 class="profile-title">Profile</h1>
                    <form action="{{route('update.profile')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" id="name" name="name" placeholder="Your name" value="{{$user->name}}" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" placeholder="Your email" value="{{$user->email}}" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" id="password" name="password" placeholder="Your password" value="{{$user->password}}" required readonly>
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender:</label>
                            <select id="gender" name="gender">
                                <option value="0" {{ $user->gender == 0 ? 'selected' : '' }}>Male</option>
                                <option value="1" {{ $user->gender == 1 ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number:</label>
                            <input type="text" id="mobile_no" name="mobile_no" placeholder="Your phone number" value="{{$user->mobile_no}}" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn-save">Save</button>
                        </div>
                    </form>
                    <a href="{{route('show.password')}}" class="btn-change-password">Change Password</a>  
                </div>
            </div>
        </div>

    </div>
    @endsection 
</body>
</html>
