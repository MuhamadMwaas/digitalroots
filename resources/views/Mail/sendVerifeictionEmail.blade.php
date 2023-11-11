<h1>digitalroots email Verification</h1>
<pre>
    HI {{ $userData['name'] }}
    TO verify your email <strong>{{ $userData['email'] }}</strong> click on link
    <form action="{{ $userData['url'] }}" method="POST" target="_blank">
        @csrf
        <input type="hidden" name="v" value="{{ $userData['token'] }}"> 
        <input type="hidden" name="email" value="{{ $userData['email'] }}"> 
        <input type="submit" value="Verify Email">

    </form>
</pre>
