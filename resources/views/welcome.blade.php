<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="_token" content="{{ csrf_token() }}"/>

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        
        <script type="text/javascript">
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
             });
        </script>
        <script>
            function getFollowers(handle,pageNumber) {
                $.ajax({
                    type: 'POST',
                    url: '/getgituser/followers',
                    headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
                    data: { user: handle.toString(), page: pageNumber.toString()},
                    success: function(data) {
                    var usersData = JSON.parse(data);
                    var realUserData = usersData;
                    $("#"+handle+" a.mylink").remove();
                        for (let i = 0; i < realUserData.length; i++) {
                            $("#"+handle).append('<img style="width:30px;" src="'+realUserData[i]['avatar_url']+'" />');
                        }
                        $('#'+handle).append('<a href="#" class="mylink" onclick="getFollowers(\''+handle+'\','+ (pageNumber++) +')" class="link">View More</a>');
                    }
                });
            }  
            function getGitUser() {
                $.ajax({
                    type: 'POST',
                    url: '/getgituser',
                    headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') } ,
                    data: { user: $("#gitUser").val() },
                    success: function(data) {
                    var usersData = JSON.parse(data);
                    var realUserData = usersData["items"];
                    $("#myTable > tbody").empty();
                        for (let i = 0; i < realUserData.length; i++) {
                            tempTR = '<tr>';
                            tempTR += '<td>'+realUserData[i]['login']+'</td>';
                            tempTR += '<td><img class="img-thumbnail" style="width:100px;" src="'+realUserData[i]['avatar_url']+'" /></td>';
                            id = realUserData[i]['login']+'-td';
                            tempTR += '<td id="'+realUserData[i]['login']+'-td"><a class="mylink" href="#" onclick="getFollowers(\''+id+'\',\'0\')">View Followers</a></td>';
                            tempTR += '</tr>';
//                            $("#myTable").html(data.msg);
                            $('#myTable > tbody:last-child').append(tempTR);
                        }
                    }
                });
            }          
        </script>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref">
            <div class="content">
                <div class="row">
                    <div class="col">
                        <label>Search Git Users:</label><input name='gitUser' id='gitUser' /><button class='btn-primary' name='searchGit' onClick ="getGitUser();" >Search</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th>Handle</th>
                                    <th>Avatar</th>
                                    <th>Followers</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
