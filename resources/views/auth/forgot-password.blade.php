<x-auth-layout site-title="forgot password">
    <x-auth-form :route="route('password.email')" method="POST">
        <x-slot name="header">forgot password</x-slot>
        <x-slot name="body">
            <p>Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>
            <x-auth-input name="email" id="email" label="email" value="{{ old('email') }}" required/>
        </x-slot>
        <x-slot name="footer">
            <x-auth-submit text="Email Password Reset Link"/>
        </x-slot>
    </x-auth-form>
</x-auth-layout>