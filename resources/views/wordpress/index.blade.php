<x-layouts.app :title="__('Dashboard')">
    <flux:heading>{{ __('WordPress Inloggen') }}</flux:heading>
    <flux:separator variant="subtle" class="" />
    <meta http-equiv="refresh" content="0; url={{ route('wordpress.client.login') }}" />
    <flux:text><a href="{{ route('wordpress.client.login') }}">{{ __('Klik hier als je niet automatisch wordt doorgestuurd.') }}</a></flux:text>
</x-layouts.app>
