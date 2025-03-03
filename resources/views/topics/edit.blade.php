@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-10 offset-md-1">
            <div class="card ">

                <div class="card-body">
                    <h2 class="">
                        <i class="far fa-edit"></i>
                        Edit topic
                    </h2>

                    <hr>

                    <form action="{{ route('topics.update', $topic->id) }}" method="POST" accept-charset="UTF-8">
                        <input type="hidden" name="_method" value="PUT">


                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        @include('shared._error')

                        <div class="mb-3">
                            <label for="title"></label>
                            <input class="form-control" type="text" id="title" name="title"
                                   value="{{ old('title', $topic->title) }}"
                                   placeholder="Please enter a title." required/>
                        </div>

                        <div class="mb-3">
                            <label for="category_id"></label>
                            <select class="form-control" id="category_id" name="category_id" required>
                                <option value="" hidden disabled selected>Please select a category.</option>
                                @foreach ($categories as $value)
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="editor"></label><textarea name="body" class="form-control" id="editor" rows="6"
                                                                  placeholder="Please enter at least 3 characters."
                                                                  required>{{ old('body', $topic->body) }}</textarea>
                        </div>

                        <div class="well well-sm">
                            <button type="submit" class="btn btn-primary"><i class="far fa-save mr-2"
                                                                             aria-hidden="true"></i> Publish
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
