@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Your Links</div>
                
                <div class="card-body">

                    <form method="POST" action="links">
                        @if (Session::has('message'))
                        <div class="alert alert-success" role="alert">
                            {{Session::get('message')}}
                        </div>
                        @endif

                        @csrf
                        <div class="form-row">
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <label for="linkUrl" class="d-none">URL</label>
                                    <input name="url" type="url" class="form-control" id="linkUrl" aria-describedby="urlHelp" placeholder="Enter a URL">
                                    <small id="urlHelp" class="form-text text-muted">You can save this link for reading later.</small>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>

                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <ul class="list-group">
                        @foreach ($links as $link)
                            <li class="list-group-item">
                                <form method="post" action="/links/delete">
                                    @method('DELETE')
                                    @csrf
                                    <a class="d-inline-block" href="{{$link->url}}" target="_blank" rel="nofollow referrer">
                                        {{ $link->url }}
                                    </a>
                                    <input type="hidden" value="{{$link->id}}" name="linkId" />
                                    <button class="btn btn-danger btn-sm float-right">x</button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
