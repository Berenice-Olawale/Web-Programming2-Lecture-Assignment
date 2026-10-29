@extends('layouts.app')

@section('title', 'Messages')

@section('content')

<section class="page-heading">
    <p class="eyebrow">INBOX</p>
    <h2>Messages</h2>
    <p>Messages sent through the contact form, newest first.</p>
</section>

@forelse ($messages as $message)
    <section class="card message-card">
        <div class="message-header">
            <h3>{{ $message->subject }}</h3>
            <span class="message-time">
                Sent: {{ $message->created_at->format('Y-m-d H:i:s') }}
            </span>
        </div>

        <p class="message-from">
            From: <strong>{{ $message->name }}</strong> ({{ $message->email }})
        </p>

        <p class="message-body">{!! nl2br(e($message->message)) !!}</p>
    </section>
@empty
    <section class="card message-card">
        <p>There are no messages yet.</p>
    </section>
@endforelse

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

    .message-card {
        margin-bottom: 16px;
    }

    .message-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        flex-wrap: wrap;
        margin-bottom: 4px;
    }

    .message-header h3 {
        color: var(--primary);
    }

    .message-time {
        color: var(--muted);
        font-size: 13px;
    }

    .message-from {
        color: var(--muted);
        font-size: 14px;
        margin-bottom: 12px;
    }
</style>
@endpush