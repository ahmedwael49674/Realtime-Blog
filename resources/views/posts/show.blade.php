@extends('layouts.app')

@section('content')
<div class="container" id="app">
  <div class="user">
    <img :src="post.user.image">
    <h3 v-text='post.user.name'></h3>
  </div>

  <h1 v-text='post.title'></h1>
  @{{post.updated_at}}
  <span class="label label-success Published" v-if="post.published">Published</span>
  <span class="label label-default Published" v-else='post.published'>Draft</span>
  <hr />
  <p class="lead" v-text='post.content'></p>

  <h3>Comments:</h3>
  <div class='commentBox' v-if="Object.keys(user).length > 0">
    <textarea class="form-control" rows="3" name="body" placeholder="Leave a comment" v-model="commentBox"></textarea>
    <button class="btn btn-success" @click.prevent="postComment">Save Comment</button>
    <hr>
  </div>

  <div v-else>
    <h4>You must login</h4>
    <a href="/login">Login now </a>
  </div>

  <div class="media" v-for="comment in comments">
    <div class="media-left">
      <img :src="comment.user.image">
    </div>

    <div class="media-body">
      <h4 class="media-heading" v-text='comment.user.name'></h4>
      <p v-text='comment.body'></p>
      <span>on @{{comment.created_at}}</span>
    </div>

    <hr>
  </div>

</div>
@endsection


@section('scripts')
<script>
  var post = {!! $post !!};
</script>
@endsection