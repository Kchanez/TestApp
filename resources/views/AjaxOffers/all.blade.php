<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title> Show All Offers</title>
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
        <h1 class="display-2 text-center m-5">
            {{__('messages.Show All Offers')}}
        </h1>
        {{-- Success message --}}

        @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{Session::get('success')}}
            </div>
        @endif
        {{-- Error message --}}
        @if(Session::has('error'))
            <div class="alert alert-danger" role="alert">
                {{Session::get('error')}}
            </div>
        @endif


        <table class="table">
            <thead>
                <tr>
                    <th scope="col">{{__('messages.ID')}}</th>
                    <th scope="col">{{__('messages.Offer Name')}}</th>
                    <th scope="col">{{__('messages.Offer Price')}}</th>
                    <th scope="col">{{__('messages.Offer Details')}}</th>
                    <th scope="col">{{__('messages.Offer Edit')}}</th>
                    <th scope="col">{{__('messages.Offer Delete')}}</th>
                </tr>
            </thead>
            @foreach ($offers as $offer)
                <tbody>
                    <tr>
                        <th scope="row">{{$offer->id}}</th>
                        <td>{{$offer->name}}</td>
                        <td>{{$offer->price . " Dz"}} </td>
                        <td>{{$offer->details}}</td>
                        <td>
                            <a href="{{url('edit/'.$offer->id)}}" class="btn btn-outline-info">{{__('messages.Edit')}}</a>
                        </td>
                        <td>
                            <a href="{{url('delete/'.$offer->id)}}" class="btn btn-outline-danger">{{__('messages.Delete')}}</a>
                        </td>
                    </tr>
                </tbody>
            @endforeach
        </table>
    </div>

</body>
</html>
