<!-- resources/views/user/profile.blade.php -->

<x-layout>

    <div class="container py-md-5 container--narrow">
        <div class="text-center">
            <h2>User Profile</h2>
        </div>

        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h3>Username: {{ $user->username }}</h3>
                        <h3>Account Opened: {{ $user->created_at }}</h3>
                        <p>Email: {{ $user->email }}</p>
                    
                        <a href="/avatarupload" class="btn" >Upload Avatar</a>  
                          
                          
                        <!-- Add other user details as needed -->

                        {{-- @if($user->posts->count() > 0)
                            <h4>User Posts</h4>
                            <ul>
                                @foreach($user->posts as $post)
                                    <li>
                                        <strong>{{ $post->title }}</strong>
                                        <p>{{ $post->content }}</p>
                                        <!-- Add other post details as needed -->
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>No posts available for this user.</p>
                        @endif --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layout>
