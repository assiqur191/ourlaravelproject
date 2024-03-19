<!-- resources/views/user/profile.blade.php -->

<x-layout :doctitle="$doctitle">
     <div class="container py-md-5 container--narrow">
        <div class="text-center">
            <h2>User Profile</h2>
        </div>

        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        {{-- <h3>Username: {{ $user->username }}</h3> --}}
                        {{-- <h3>Account Opened: {{ $user->created_at }}</h3> --}}
                        {{-- <p>Email: {{ $user->email }}</p>  --}}
                            
                        
                        <div class="container py-md-5 container--narrow">
                            <h2>
                              {{-- {{$a = 3}} --}}
                              {{-- {{}} --}}
                               {{-- {{print_r(gettype($sharedData['avatar']))}}  --}}
                                   {{-- {{ dd($sharedData) }} --}}

                               {{-- <h1>{{echo $sharedData}}</h1> --}}
                               {{-- <h1>{{}}</h1> --}}

                              <img class="avatar-small" src="/public/image/{{$sharedData['avatar']}}" /> {{$sharedData['username']}}
                              {{-- <img class="avatar-small" src="/public/image/{{$sharedData['avatar']}}" /> {{$sharedData['username']}} --}}
                              
                              @auth
                              @if(!$sharedData['isfollowing'] AND auth()->user()->username != $sharedData['username'])
                              <form class="ml-2 d-inline" action="/create-follow/{{$sharedData['username']}}" method="POST">
                                @csrf
                                <button class="btn btn-primary btn-sm">Follow <i class="fas fa-user-plus"></i></button>
                                
                                <!-- <button class="btn btn-danger btn-sm">Stop Following <i class="fas fa-user-times"></i></button> -->
                              </form>
                              @endif
                              @if($sharedData['isfollowing'])
                              <form class="ml-2 d-inline" action="/remove-follow/{{$sharedData['username']}}" method="POST">
                                @csrf
                                <button class="btn btn-primary btn-sm">Follow <i class="fas fa-user-plus"></i></button>
                                <!--<a href="/avatarupload" class="btn btn-primary btn-sm" >Upload Avatar</a> -->
                             <button class="btn btn-danger btn-sm"> Unfollow <i class="fas fa-user-times"></i></button> 
                              </form>
                              @endif
                              
                              
                              @endauth 
                              
                              @auth
                                <a href="/avatarupload" class="btn btn-primary btn-sm" >Upload Avatar</a>  
                              @endauth
                              
                            </h2>
                      
                            <div class="profile-nav nav nav-tabs pt-2 mb-4">
                              <a href="/profile/{{$sharedData['username']}}" class="profile-nav-link nav-item nav-link {{Request::segment(3)==" " ? "active" : ""}}">Posts:{{$sharedData['postCount']}}</a> 
                              <a href="/profile/{{$sharedData['username']}}/followers" class="profile-nav-link nav-item nav-link {{Request::segment(3)=="followers" ? "active" : ""}}">Followers:{{$sharedData['followersCount']}}</a>
                              <a href="/profile/{{$sharedData['username']}}/following" class="profile-nav-link nav-item nav-link {{Request::segment(3)=="following" ? "active" : ""}}">Following:{{$sharedData['followingCount']}}</a>
                            </div> 
                            <div class="profile-slot-content">
                                {{$slot}}
                            </div>
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layout>
