<x-profilecomponent :sharedData="$sharedData" doctitle="{{$sharedData['username']}}'s Profile">
{{-- <x-profilecomponent :sharedData="$jinish"> --}}


 
  

  <div class="list-group">
    @foreach($posts as $post)
    <a href="/post/{{$post->id}}" class="list-group-item list-group-item-action">
      <img class="avatar-tiny" src="/public/image/{{$sharedData['avatar']}}" />
      <strong>{{$post->title}}</strong> on {{$post->created_at->format(' d/m/Y')}}
    </a>
    @endforeach
    
  </div>








</x-profilecomponent>