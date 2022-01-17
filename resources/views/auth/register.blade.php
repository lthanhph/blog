<x-auth-layout site-title="register">
    <x-auth-form :route="route('register')" method="POST">
        <x-slot name="header">register</x-slot>
        <x-slot name="body">
            <x-auth-input name="name" id="name" label="user name" value="{{ old('name') }}" requried/>
            <x-auth-input type="email" name="email" id="email" label="email" value="{{ old('email') }}" required/>
            <x-auth-input type="password" name="password" id="password" label="password" required/>
            <x-auth-input type="password" name="password_confirmation" id="password_confirmation" label="Confirm Password" requried/>
        </x-slot>
        <x-slot name="footer">
            <a href="{{ route('login') }}" class="text-dark me-3">Already registered?</a>
            <x-auth-submit text="register"/>
        </x-slot>
    </x-auth-form>
</x-auth-layout>