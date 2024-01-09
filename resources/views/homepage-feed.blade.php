<x-layout>

    <div class="container py-md-5 container--narrow">
        <div class="text-center">
          <a href="/viewpost" class="d-inline">look your all post</a>
          <h2>Hello <strong>{{auth()->user()->username}}</strong>, here is your all feeds </h2>
           
          <p class="lead text-muted">Your feed displays the latest posts from the people you follow. If you don&rsquo;t have any friends to follow that&rsquo;s okay; you can use the &ldquo;Search&rdquo; feature in the top menu bar to find content written by people with similar interests and then follow them.</p>
        </div>
      </div>
  


</x-layout>

