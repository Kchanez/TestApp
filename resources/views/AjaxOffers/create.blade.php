<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{__('messages.Create Offers')}}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>



    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">{{__('messages.Navbar')}}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                <li class="nav-item active">
                    <a class="nav-link" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                        {{ $properties['native'] }}
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
            @endforeach
        </ul>
        <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="{{__('messages.Search')}}" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">{{__('messages.Search')}}</button>
        </form>
    </div>
    </nav>

    <div class="container mt-5">
        <h1 class="display-2 text-center">
                {{__('messages.Add an Offer')}}
        </h1>
        @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{Session::get('success')}}
            </div>
        @endif

        <form   id="offerForm"  class="mt-5" enctype="multipart/form-data">
            @csrf

            {{-- <div class="form-group">
                <label for="Photo">{{__('messages.photo')}} </label>
                <input type="file" class="form-control" name="photo"   value="{{old('photo')}}">
                @error('photo')
                    <div class="alert alert-danger"> {{ $message }} </div>
                @enderror
            </div> --}}
            <div class="form-group">
                <label for="Name">{{__('messages.name')}} </label>
                <input type="text" class="form-control" name="name" id="name" aria-describedby="emailHelp" placeholder="{{__('messages.Enter your name')}}" >
                @error('name')
                    <div class="alert alert-danger"> {{ $message }} </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="price">{{__('messages.Price')}}</label>
                <input type="text" class="form-control" name="price" id="price" placeholder="{{__('messages.Enter your price')}}" >
                @error('price')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="details">{{__('messages.details')}}</label>
                <input type="text" class="form-control" name="details" id="details" placeholder="{{__('messages.Enter details')}}" >
                @error('details')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" id="saveOffer" class="btn btn-primary">{{__('messages.Submit')}}</button>
        </form>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>

        $(document).ready(function(e){
            $('#saveOffer').on('click',function (e) {
                e.preventDefault();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "post",
                    dataType: "json",
                    url: "{{url('store')}}",
                    //enctype:"multipart/form-data",
                    cache: false,
                    /* contentType: false,
                    processData:false, */
                    data:{
                        //'photo' : $("input[name='photo']").val(),
                        'name' : $("input[name='name']").val(),
                        'price' : $("input[name='price']").val(),
                        'details': $("input[name='details']").val(),
                    },
                    success:function(data){
                        console.log(data);
                    },
                    error:function(data){
                        console.log(data);
                    },
                    success: function(response){
                        console.log(response);
                    },
                    error: function(reject){
                    },
                });
            });
        });
    </script>

    <script   src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <script   src="https://code.jquery.com/jquery-migrate-1.2.1.min.js" ></script>
</body>
</html>
