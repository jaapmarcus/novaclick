<div>
    <flux:heading size="lg" level="2" class="mb-6">{{ __('Wijzig gebruiker') }}</flux:heading>
    <flux:separator variant="subtle" class="mb-6" />
    <div class="grid auto-rows-min gap-4 md:grid-cols-2">
            <div class="relative">
                <flux:heading size="md" level="3" class="m-4">{{ __('Gebruikersinformatie') }}</flux:heading>
                <flux:separator variant="subtle" class="mb-4" />
                <div class="p-4">
                    <flux:input name="company" :label="__('Bedrijfsnaam')" type="text" :placeholder="__('Bedrijfsnaam')" wire:model="company_name" />
                    <flux:input.group :label="__('Naam')">
                        <flux:input name="name" type="text" :placeholder="__('Voornaam')" wire:model="name" class="flex-1" />
                        <flux:input name="last_name" type="text" :placeholder="__('Achternaam')" wire:model="last_name" class="flex-1" />
                    </flux:input.group>
                    <flux:input.group :label="__('Adress')">
                        <flux:input name="adress" type="text" :placeholder="__('Adres')" wire:model="address" class="flex-1" />
                        <flux:input name="house_number" type="text" :placeholder="__('Huisnummer')" wire:model="house_number" class="flex-1" />
                        <flux:input name="house_number_suffix" type="text" :placeholder="__('Toevoeging')" wire:model="house_number_suffix" class="flex-1" />
                    </flux:input.group>
                    <flux:input.group :label="__('Postcode, stad, land')">
                        <flux:input name="postal_code" type="text" :placeholder="__('Postcode')" wire:model="postal_code" class="flex-1" />
                        <flux:input name="city" type="text" :placeholder="__('Stad')" wire:model="city" class="flex-1" />
                        <flux:input name="country" type="text" :placeholder="__('Land')" wire:model="country" class="flex-1" />
                    </flux:input.group>
                    <flux:input name="phone" :label="__('Telefoonnummer')" type="text" :placeholder="__('Telefoonnummer')" wire:model="phone_number" />
                    <flux:input name="vat_number" :label="__('BTW-nummer')" type="text" :placeholder="__('BTW-nummer')" wire:model="vat_number" />
                    <flux:input name="email" :label="__('E-mailadres')" type="email" :placeholder="__('E-mailadres')" wire:model="email" />
                </div>
            </div>
            <div class="relative">
                <flux:heading size="md" level="3" class="m-4">{{ __('Acties') }}</flux:heading>
                <flux:separator variant="subtle" class="mb-4" />
                <flux:button size="sm" variant="outline" href="{{ route('wordpress.login', $user->id) }}" variant="primary">{{ __('Login in Wordpress') }}</flux:button>
                <flux:heading size="md" level="3" class="m-4 mt-8">{{ __('Extra Info') }}</flux:heading>
                <flux:separator variant="subtle" class="mb-4" />
                <flux:input name="domain" :label="__('Domeinnaam')" type="text" :placeholder="__('Domeinnaam')" wire:model="domain"  />
                <flux:input name="username" :label="__('Gebruikersnaam')" type="text" :placeholder="__('Gebruikersnaam')" wire:model="username"  />
                <flux:input name="server" :label="__('Server ID')" type="text" :placeholder="__('Server ID')" wire:model="server_id"  />
                <flux:input name="sftp_password" :label="__('SFTP Wachtwoord')" type="text" :placeholder="__('SFTP Wachtwoord')" wire:model="sftp_password"  />
                <flux:input name="application_password" :label="__('Applicatie Wachtwoord')" type="text" :placeholder="__('Applicatie Wachtwoord')" wire:model="application_password"  />
                <flux:input name="places_id" :label="__('Places ID')" type="text" :placeholder="__('Places ID')" wire:model="places_id"  />
            </div>
        </div>
</div>
