@extends('layouts.master')

@section('title', 'Подтвердите почту')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/css.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/verify.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
@endsection

@section('content')
<div class="verify-container">
    <div class="verify-card">
        <div class="verify-icon">
            <i class="fas fa-envelope"></i>
        </div>
        <h1 class="verify-title">Подтвердите вашу почту</h1>
        <p class="verify-text">
            Мы отправили письмо с подтверждением на ваш email. 
            Пожалуйста, проверьте вашу почту и перейдите по ссылке для подтверждения.
        </p>
        
        @if(session('success'))
            <div class="message-container success">
                {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="message-container error">
                {{ session('error') }}
            </div>
        @endif
        
        <div class="verify-actions">
            @if(session('can_resend', true))
                <form action="{{ route('verification.resend') }}" method="POST">
                    @csrf
                    <button type="submit" class="resend-button">
                        Отправить письмо повторно
                    </button>
                </form>
            @else
                <div class="resend-button disabled">
                    Отправить письмо повторно
                </div>
                <div class="timer-container">
                    <span>{{ session('resend_time', 15) }}</span> сек.
                </div>
            @endif
        </div>
    </div>
</div>

@endsection
