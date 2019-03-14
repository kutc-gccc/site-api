@extends('layouts.app')

@section('content')


<div class="container">
    <a class="btn btn btn-outline-secondary" href="/home" role="button">ホームに戻る</a>
    <hr>
    @if(count($title_datas)>0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>
                        title_id
                    </th>
                    <th>
                        タイトル
                    </th>
                    <th>
                    </th>
                    <th>
                    </th>
                </tr>
            </thead>
            <tbody>
            @foreach ($title_datas as $title_data)
                <tr>
                    <th>{{$title_data->id}}</th>
                    <th>{{$title_data->title}}</th>
                    <th>
                        <form method="POST" action="/delete/{{$title_data->id}}/view-all/" >
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit"  class="btn btn-danger btn-sm">削除</button>
                        </form>
                    </th>
                    <th><a class="btn btn-primary btn-sm" href="/view/{{$title_data->id}}" target="_blank" role="button">表示を確認</a></th>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        登録されているデータはありません
    @endif
</div>
@endsection

