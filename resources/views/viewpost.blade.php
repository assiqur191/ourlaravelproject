<!-- resources/views/viewpost.blade.php -->

<x-layout>

    <div class="container py-md-5 container--narrow">
        <div class="text-center">
            <h2>User Posts</h2>
        </div>

        @if($userPosts->count() > 0)
            <div class="row">
                @foreach($userPosts as $post)
                    <div class="col-md-6">
                        <div class="card mb-4 shadow-sm">
                            <div class="card-body">
                                <button >{{ $post->title }}</button>
                                <h6>{{ $post->content }}</h6>
                                <a href="{{ url('/post/' . $post->id) }}" class="d-inline">View this post</a>

                                {{-- <a href="{{ route('viewSinglePost', ['post' => $post]) }}" class="btn btn-primary">View Full Post</a> --}}

                                <!-- Add other post details as needed -->
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>No posts available for this user.</p>
        @endif
    </div>

</x-layout>
