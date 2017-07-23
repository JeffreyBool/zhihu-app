@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $question->title }}</div>
                    <div class="panel_heading">
                        <div class="Popover">
                            @foreach($question->topics as $topic)
                                <a href=" /topic/{{$topic->id}}" class="TopicLink"><span class="topics">{{$topic->name}}</span></a>
                            @endforeach
                        </div>
                    </div>
                    <div class="panel-body">
                        {!! $question->content !!}
                    </div>
                    <div class="actions">
                        @if(Auth::check() && Auth::user()->owns($question))
                            <span class="edit"><a href="/questions/{{$question->id}}/edit">编辑</a></span>
                            <form action="/questions/{{$question->id}}" method="post" class="delete-form">
                                {{method_field('DELETE')}}
                                {{csrf_field()}}
                                <button class="button is-naked delete-button">删除</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection