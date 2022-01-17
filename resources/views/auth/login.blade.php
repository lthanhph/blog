<x-auth-layout site-title="login">
    <x-auth-form :route="route('login')" method="POST">
        <x-slot name="header">login</x-slot>
        <x-slot name="body">
            <x-auth-input name="name" label="user name" value="{{ old('name') }}" requried />
            <x-auth-input type="password" name="password" label="password" required />
            <x-auth-checkbox name="remember_me" id="remember" label="Remember me" />
        </x-slot>
        <x-slot name="footer">
            <a href="{{ route('password.request') }}" class="text-dark me-3">Forgot your password?</a>
            <x-auth-submit text="login" />
        </x-slot>
    </x-auth-form>
</x-auth-layout>