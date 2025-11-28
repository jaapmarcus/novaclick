<div class="flex flex-col gap-4">
    <flux:heading size="md" level="3" class="">{{ __('Wizard Informatie') }}</flux:heading>
    <flux:separator variant="subtle" class="" />
    <flux:input type="text" :label="__('Domeinnaam')" :placeholder="__('Domeinnaam')" wire:model="domain_name" readonly />
    @if($transfer_token)
    <flux:input type="text" :label="__('Verhuis Token')" :placeholder="__('Verhuis Token')" wire:model="transfer_token" />
    @endif
    <flux:textarea :label="__('Places ID')" wire:model="place_id" readonly />
    <flux:textarea :label="__('Doelgroep')" wire:model="target_audience" readonly />
    <flux:textarea :label="__('Website Doelen')" wire:model="website_goals" readonly />
    <flux:textarea :label="__('Gewenste Pagina\'s')" wire:model="desired_pages" readonly />
    <flux:textarea :label="__('Contactformulier')" wire:model="contact_form" readonly />
    <flux:textarea :label="__('Extra Informatie')" wire:model="additional_info" readonly />
    <flux:textarea :label="__('Aangeboden Diensten')" wire:model="services_offered" readonly />
    <flux:heading size="md" level="4" class="">{{ __('Kleuren') }}</flux:heading>
    <flux:input type="text" :label="__('Tekstkleur')" wire:model="text_color" />
    <flux:input type="text" :label="__('Achtergrondkleur')" wire:model="background_color" />
    <flux:input type="text" :label="__('Primaire Kleur')" wire:model="primary_color" />
    <flux:heading size="md" level="4" class="">{{ __('Bestanden / Foto\'s') }}</flux:heading>
    @if($files && count($files) > 0)
        <ul class="list-disc list-inside">
            @foreach($files as $file)
                <li><a href="{{ route('download', ['id' => $file -> id, 'file' => $file -> original_name]) }}" target="_blank" class="text-blue-600 underline">{{ $file->original_name }}</a></li>
            @endforeach
        </ul>
    @else
        <flux:text>{{ __('Geen bestanden geüpload.') }}</flux:text>
    @endif
    <flux:textarea :label="__('Teksten / Dropbox / Google Drive links')" wire:model="text_images" readonly></flux:textarea>
</div>
