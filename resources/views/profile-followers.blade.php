<x-profilecomponent :sharedData="$sharedData" doctitle="{{$sharedData['username']}}'s Followers">


  

    <div class="list-group">
      @foreach($followers as $follow)
      <a href="/post/{{$follow->userDoingTheFollowing->username}}" class="list-group-item list-group-item-action">
        <img class="avatar-tiny" src="/public/image/{{$follow->userDoingTheFollowing->avatar}}" />
       {{$follow->userDoingTheFollowing->username}}
      </a>
      @endforeach
      
    </div>
  
  
   
  
  
  
  
  
  </x-profilecomponent>