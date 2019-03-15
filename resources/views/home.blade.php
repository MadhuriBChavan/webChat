@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">We Chat Messenger</div>
                <div class="card-body" id="app">
                    <chat_app :user= "{{auth()->user()}}"></chat_app>

                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
