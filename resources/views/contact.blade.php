@extends('layouts.app')

@section('title', 'Contact')

@section('content')

<section class="page-heading">
    <p class="eyebrow">GET IN TOUCH</p>
    <h2>Contact us</h2>
    <p>
        Have a question about one of our refurbished laptops?
        Send us a message and we will get back to you.
    </p>
</section>

<section class="card contact-card">
    @if (session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('contact.store') }}" method="POST">
        @csrf

        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}">
        @error('name')
            <span class="field-error">{{ $message }}</span>
        @enderror

        <label for="email">E-mail</label>
        <input type="text" id="email" name="email" value="{{ old('email') }}">
        @error('email')
            <span class="field-error">{{ $message }}</span>
        @enderror

        <label for="subject">Subject</label>
        <input type="text" id="subject" name="subject" value="{{ old('subject') }}">
        @error('subject')
            <span class="field-error">{{ $message }}</span>
        @enderror

        <label for="message">Message</label>
        <textarea id="message" name="message" rows="6">{{ old('message') }}</textarea>
        @error('message')
            <span class="field-error">{{ $message }}</span>
        @enderror

        <button type="submit">Send message</button>
    </form>
</section>

@endsection

@push('styles')
<style>
    .eyebrow {
        color: var(--accent);
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 1.7px;
        margin-bottom: 8px;
    }

    .contact-card {
        max-width: 640px;
    }

    .contact-card label {
        display: block;
        margin-top: 16px;
        font-weight: 600;
    }

    .contact-card input,
    .contact-card textarea {
        width: 100%;
        padding: 10px 12px;
        font: inherit;
        border: 1px solid var(--border);
        border-radius: 8px;
    }

    .contact-card button {
        margin-top: 20px;
        padding: 11px 22px;
        font: inherit;
        cursor: pointer;
        background: var(--primary);
        color: #ffffff;
        border: 0;
        border-radius: 8px;
    }

    .contact-card button:hover {
        background: var(--primary-hover);
    }

    .field-error {
        color: #b42318;
        font-size: 14px;
    }

    .alert-success {
        background: #e7f6ec;
        color: #1e6b2e;
        padding: 12px 16px;
        border-radius: 8px;
        margin-bottom: 16px;
    }
</style>
@endpush