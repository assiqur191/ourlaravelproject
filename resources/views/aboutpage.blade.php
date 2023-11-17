<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<title>Page Title</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="">
<style>
</style>
<script src=""></script>
<body>
    <h3>About page</h3> <br>

    <h1>All pets name is :- </h1>
{{-- @foreach ($allpets as $pets)

<li> {{$pets}}</li>
@endforeach --}}
@foreach ($users as  $user)

{{-- <a href="   {{       route('profile',     [   'userid'  =>   $user['id'] , 'name'  =>   $user['name']    ]       )     }}      "> --}}
<a href="   {{       route('profile',$user)     }}      ">
    {{$user['name']}}
    {{print_r($user)}}
</a> <br>
@endforeach

<br>
<a href="/">Back to the home page</a>;
    
</body>
</html> 