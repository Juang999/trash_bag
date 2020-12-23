@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="page-content--bge5">
        <div class="container">
            <div class="login-wrap">
                <div class="login-content">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="login-logo">
                        <a href="#">
                            <img style="width: 55px; height: 55px; " src="{{ url('images/icon/title-icon2.png')}}" alt="Cool Admin" />
                            <h2 style=" display: inline;">Trash Bag</h2>
                        </a>
                    </div>
                    <div class="login-form">
                        <form action="{{ route('password.email') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Email Address</label>
                                <input class="au-input au-input--full @error('email') is-invalid @enderror" type="email" name="email" placeholder="Email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

