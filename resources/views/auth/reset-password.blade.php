<x-auth-layout site-title="reset password">
    <x-auth-form :route="route('password.update')" method="POST">
        <x-slot name="header">reset password</x-slot>
        <x-slot name="body">
            <input type="hidden" name="token" value="{{ $request->route('token') }}">
            <x-auth-input type="email" name="email" id="email" label="email" value="{{ old('email', $request->email) }}" required/>
            <x-auth-input type="password" name="password" id="password" label="password" required/>
            <x-auth-input type="password" name="password_confirmation" id="password_confirmation" label="Confirm Password" required/>
        </x-slot>
        <x-slot name="footer">
            <x-auth-submit text="reset password"/>
        </x-slot>
    </x-auth-form>
</x-auth-layout>