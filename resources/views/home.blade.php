@extends('layouts.app')

@section('content')


<div class="container">
    @if (session('flash_message'))
        <div class="alert alert-success" role="alert">
                {{ session('flash_message') }}
        </div>
    @endif

    @if (session('login_success'))
        <div class="alert alert-info" role="alert">
            {{ session('login_success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div>
        <a href="/view-all" class="btn btn-primary" role="button" >今までアップロードしたファイル一覧</a>
    </div>
    <hr>
    <div>
        MarkDownまたはHTMLファイルをアップロード
    </div>
    <form method="POST" action="/upload" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="input-group">
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="customFile" name="upfile" accept=".md, .html">
                <label class="custom-file-label" for="customFile">ファイル選択...</label>
            </div>
            <div class="input-group-append">
                <button type="button" class="btn btn-outline-secondary reset">Cancel</button>
            </div>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">記事のタイトル名</label>
            <input type="text" class="form-control" id="formGroupExampleInput" name="article_title" placeholder="タイトル...">
        </div>
        <hr>
        <div class="row justify-content-center">
        <button type="submit"  class="btn btn-secondary btn-lg">ファイルを送信</button>
        </div>

    </form>

    @if(isset($edit_flag) && $edit_flag)
        <hr>
        <div class="row justify-content-center">
            <p>アップロードしたファイル　タイトル「{{$title}}」<p>
        </div>
        <div class="row justify-content-center">
            <form method="POST" action="/delete/{{$id}}/home" >
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit"  class="btn btn-danger">削除</button>
            </form>
            <a href="/view/{{$id}}" class="btn btn-primary" style="margin-left:20px" role="button" target="_blank">表示を確認</a>
        </div>
    @endif
</div>
@endsection

