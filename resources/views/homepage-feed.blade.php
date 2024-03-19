{{-- <x-layout>
  <div class= "py-5"   >
  @php
  $successMassage= "Successfully saved";
      
  @endphp

  <x-alert-massage:massage="$successMassage"/>
  </div>

    <div class="container py-md-5 container--narrow">
        <div class="text-center">
          {{-- href="{{ URL('/dashboard/medicinepending/'.$val->id )}}" --}}

          {{-- <a href="{{ url('/viewpost'.$val->auth()->user()->id )}} class="d-inline">look your all post</a> --}}
          {{-- <a href="/viewpost/{user_id}" class="d-inline">look your all post</a> --}}
          {{-- <h2>Hello <strong>{{auth()->user()->username}}</strong>, here is your all feeds </h2> --}}
           
          {{-- <p class="lead text-muted">Your feed displays the latest posts from the people you follow. If you don&rsquo;t have any friends to follow that&rsquo;s okay; you can use the &ldquo;Search&rdquo; feature in the top menu bar to find content written by people with similar interests and then follow them.</p> --}}
        {{-- </div> --}}
      {{-- </div> --}}
  


{{-- </x-layout> --}}
 
<x-layout>

      <div class="container py-md-5 container--narrow">
      
        {{-- href="{{ URL('/dashboard/medicinepending/'.$val->id )}}" --}}
        
                     
                    
        
    
             {{-- <a href="{{ url('/viewpost/' . auth()->user()->id) }}" class="d-inline">Look at your all posts</a> --}}
              {{-- <a href="/viewpost/{user_id}" class="d-inline">look your all post</a> --}}
              
       
             
        
        
             
         @unless($posts->isEmpty())
         <h2 class="text-center mb-4">Latest Feed for you</h2> 
         
          <div class="list-group">
           @foreach($posts as $post)
              
           
           <a href="/post/{{$post->id}}" class="list-group-item list-group-item-action">
             <img class="avatar-tiny" src="/public/image/{{$post->user->avatar}}" />
             <strong>{{$post->title}}</strong> by {{$post->user->username}} on {{$post->created_at->format(' d/m/Y')}}
           </a>
          @endforeach
           
         </div>
          <div class="mt-4">
         {{$posts->links()}}
          </div>   
          @else
           <div class="text-center">
          <h2>Hello <strong>{{ auth()->user()->username }}</strong>, here are your posts</h2>
          
          <p class="lead text-muted">your feed is empty</p>
           </div>
          @endunless
       
   </div>
      
       

</x-layout>
