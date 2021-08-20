<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>{{ config('app.name', 'PHP Test') }}</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        .form {
            margin: 0% 16%;
        }
        .error{
            display:none;
        }
        .alert-danger {
            color: #761b18;
            background-color: #f9d6d5;
            border-color: #f7c6c5;
            padding: 2px;
            width: 28%;
            margin-left: 17%;
        }
        #showData, #showForm{
            float:right;
        }
        
        #infoTable {
            width: 74%;
            margin: 0% 16%;
        }
    </style>
</head>
<body>
    <div class="container">
        <br>
        <button id="showData" class="btn btn-success">Data</button>
        <button id="showForm" class="btn btn-success" style="display:none;">From</button>
        <center><h1>PHP Interview Test</h1></center>
        <br>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="form" id="infoFrom">
            <form  method="post" action="{{ route('StdReg') }}">
                @csrf
            <div class="form-group row">
                <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputName" name="name" placeholder="Name" autocomplete="off">
                    <span class="error" id="invalid_name">Please Eneter Name</span>
                </div>
            </div>
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email" autocomplete="off" required>
                    <span class="error" id="invalid_email"></span>
                </div>
            </div>
            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <fieldset class="form-group">
                <div class="row">
                <legend class="col-form-label col-sm-2 pt-0">Hobbies</legend>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck1" name="hobbies[]" value="singing">
                        <label class="form-check-label" for="gridCheck1">
                        Singing
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck2" name="hobbies[]" value="dancing">
                        <label class="form-check-label" for="gridCheck1">
                        Dancing
                         </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck3" name="hobbies[]" value="indoor games">
                        <label class="form-check-label" for="gridCheck1">
                        Indoor Games
                         </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck4" name="hobbies[]" value="outdoor games">
                        <label class="form-check-label" for="gridCheck1">
                        Outdoor Games
                         </label>
                    </div>
                    <div class="form-check disabled">
                        <input class="form-check-input" type="checkbox" id="gridCheck1" name="hobbies[]" value="others">
                        <label class="form-check-label" for="gridCheck1">
                        Others
                         </label>
                    </div>
                </div>
                </div>
            </fieldset>
            @error('hobbies')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="form-group row">
                <div class="col-sm-10">
                <button id="button" class="btn btn-primary">Submit</button>
                </div>
                 <input type="submit" name="submit_btn" id="submit_btn" style="display: none;" />
            </div>
        </form>
        </div>
        <div id="infoTable" style="display:none;">
            <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Hobbies</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $std)
                <tr>
                    <th scope="row">{{ $std->id }}</th>
                    <td>{{ $std->name }}</td>
                    <td>{{ $std->email }}</td>
                    <td>
                            <ul>
                                <?php $arr = json_decode($std->hobbies); ?>
                                @foreach($arr as $b)
                                <li>{{ucwords($b)}}</li>
                                @endforeach
                            </ul>
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table>
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<Script>
    $("#showData").click(function(){
        $("#infoFrom").hide();
        $("#infoTable").show();
        $("#showData").hide();
        $("#showForm").show();
    });

    $("#showForm").click(function(){
        $("#infoFrom").show();
        $("#infoTable").hide();
        $("#showData").show();
        $("#showForm").hide();
    });

    $(document).ready(function() {
        $("#inputEmail").on('change', function(){ 
            var attr = $(this).attr('name');
            var val = $(this).val();
            if(attr == 'email')
            {
                if(val == '')
                {
                    $("#invalid_email").replaceWith("Email Required");
                }else{
                    if(IsEmail(val)==false)
                    {
                        $("#invalid_email").replaceWith("Email-id is invalid");
                        $("#invalid_email").css("color", "red");
                        $('#invalid_email').show();
                        $("#inputEmail").focus();
                        return false;
                    }else{
                        $('#invalid_email').hide();
                    }
                }
            }
        });
        
        function IsEmail(email)
        {
            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if(!regex.test(email)) {
                return false;
            }else{
                return true;
            }
        }
    });
</Script>
</body>
</html>