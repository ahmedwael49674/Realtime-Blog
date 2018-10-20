@extends('layouts.app') @section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/fileinput.min.css') }}" rel="stylesheet"> @endsection @section('content')
<div class="container">
    <h1>edit Account</h1>
    <hr />
    <form method="post" action="{{ route('users.update', $user->id) }}" id="update-account" enctype="multipart/form-data">
        {{ method_field('put') }} {{ csrf_field() }}
        <div class="row">

            <div class="profilePic col-md-3" id="profilePic">
                <img src="{{asset($user->image)}}" class="img-circle">
            </div>
            <div class="col-md-9">
                <div class="form-group">
                    <label for="post_title">Name : </label>
                    <input type="text" class="form-control" id="name" placeholder="Name" value="{{ $user->name }}" name="name" required>
                </div>

                <div class="form-group">
                    <label for="post_content">E-mail :</label>
                    <input type="text" class="form-control" id="email" placeholder="E-mail" value="{{ $user->email }}" name="email" required>
                </div>

                <div class="form-group">
                    <label for="post_content">Password :</label>
                    <input type="text" class="form-control" id="password" placeholder="Password" name="password">
                </div>
                <div class="form-group" id="imageEdit" style="display:none;">
                    <input id="file-demo" type="file" class="file" name="image" multiple=true data-preview-file-type="any">
                </div>
            </div>
        </div>
    </form>
    <div class="fromButtons">
        <button onclick="editImageForm()" class="btn btn-primary btn-lg">edit image</button>
        <button onclick="event.preventDefault();
             document.getElementById('update-account').submit();" class="btn btn-success btn-lg">Save</button>
    </div>
</div>
@endsection @section('scripts')
<script src="{{ asset('js/fileinput.min.js') }}"></script>
<script>
    function editImageForm() {
        document.getElementById('profilePic').style.display = 'none';
        document.getElementById('imageEdit').style.display = 'inline';
    }

</script>
@endsection
