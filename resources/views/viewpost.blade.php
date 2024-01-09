<x-layout>

<h1>Here is your all posts title </h1>
@foreach ($posts as $post)
<li>{{$post->title}}</li>
    
@endforeach


</x-layout>