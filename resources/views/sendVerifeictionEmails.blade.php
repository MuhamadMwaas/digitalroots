<x-mail::message>
    # Introduction

    The body of your message.

    <form action="{{ $userData['url'] }}" method="POST" target="_blank">
        @csrf
        <input type="hidden" name="v" value="{{ $userData['token'] }}">
        <input type="hidden" name="email" value="{{ $userData['email'] }}">
        <input type="submit" value="Verify Email">

    </form>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
