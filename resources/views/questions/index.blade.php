@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="clo-md-8 clo-md-offset-2">
                @foreach($questions as $question)
                    <div class="media">
                        <div class="media-left">
                            <a href="{{$question->user->avater}}" >
                                <img src="{{$question->user->avatar}}" alt="{{$question->user->name}}" width="40">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">
                                <a href="/questions/{{$question->id}}">
                                    {{$question->title}}
                                </a>
                            </h4>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection