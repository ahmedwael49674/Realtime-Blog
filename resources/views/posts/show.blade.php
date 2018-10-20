@extends('layouts.app')

@section('content')
  <div class="container" id="app">
   <div class="user">
        <img  src="{{asset($post->user->image)}}" alt="..." style="display: inline;border-radius: 50%;width: 110px;height: 105px;">
        <h3 style="display:inline">{{$post->user->name}}</h3>
   </div>

    <h1>{{ $post->title }}</h1>
    {{ $post->updated_at->toFormattedDateString() }}
    @if ($post->published)
      <span class="label label-success" style="margin-left:15px;">Published</span>
    @else
      <span class="label label-default" style="margin-left:15px;">Draft</span>
    @endif
    <hr />
    <p class="lead">
      {{ $post->content }}
    </p>

    <h3>Comments:</h3>
     <div style="margin-bottom:50px;" v-if="user">
           <textarea class="form-control" rows="3" name="body" placeholder="Leave a comment" v-model="commentBox"></textarea>
      <button class="btn btn-success" style="margin-top:10px" @click.prevent="postComment">Save Comment</button>
    <hr>
    </div>
    <div v-else>
        <h4>You must login</h4>
        <a href="/login">Login now </a>
    </div>

    <div class="media" style="margin-top:20px;" v-for="comment in comments">
      <div class="media-left">
          <img class="media-object" :src="'http://localhost:8000/'+comment.user.image" style="display: inline;border-radius: 50%;width: 110px;height: 105px;">
      </div>
      <div class="media-body" style="padding: 20px 9px;">
        <h4 class="media-heading">@{{comment.user.name}}</h4>
        <p>
          @{{comment.body}}
        </p>
        <span style="color: #aaa;">on @{{comment.created_at}}</span>
      </div>
     <hr>
    </div>
  </div>
@endsection


@section('scripts')
  <script>
    window.onload = function () {
    const app = new Vue({
      el: '#app',
      data: {
        comments: {},
        commentBox: '',
        post: {!! $post->toJson() !!},
        user: {!! Auth::check() ? Auth::user()->toJson() : 'null' !!}
      },
      mounted() {
        this.getComments();
        this.listen();
      },
      methods: {
        getComments() {
          axios.get('/api/posts/'+this.post.id+'/comments')
                .then((response) => {
                  this.comments = response.data;
                })
                .catch(function (error) {
                  console.log(error);
                });
        },
        postComment() {
          axios.post('/api/posts/'+this.post.id+'/comment', {
            api_token: this.user.api_token,
            body: this.commentBox
          })
          .then((response) => {
            this.comments.unshift(response.data);
            this.commentBox = '';
          })
          .catch((error) => {
            console.log(error);
          })
        },
        listen(){
            Echo.private('post.'+this.post.id)
                .listen('NewComment',(comment)=>{
                console.log('hi');
                this.comments.unshift(comment);
            })
        }
      }
    });
    }
  </script>
@endsection
