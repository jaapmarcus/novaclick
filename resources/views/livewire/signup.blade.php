<div>
      <flux:heading size="xl" level="2">{{ __('Factuur gegevens') }}</flux:heading>
        <flux:separator variant="subtle" />
        <form wire:submit.prevent="submitForm" class="flex flex-col gap-6 mt-4">
            <flux:input type="text" name="company_name" :label="__('Bedrijfsnaam')" wire:model.defer="company_name" :placeholder="__('Bedrijfsnaam')" required />
            <flux:input type="text" name="address" :label="__('Straat naam')" wire:model.defer="address" :placeholder="__('Adres')" required />
            <flux:input type="text" name="house_number" :label="__('Huisnummer')" wire:model.defer="house_number" :placeholder="__('Huisnummer')" required />
            <flux:input type="text" name="house_number_suffix" :label="__('Toevoeging')" wire:model.defer="house_number_suffix" :placeholder="__('Toevoeging')" />
            <flux:input type="text" name="postal_code" :label="__('Postcode')" wire:model.defer="postal_code" :placeholder="__('Postcode')" required />
            <flux:input type="text" name="city" :label="__('Plaats')" wire:model.defer="city" :placeholder="__('Plaats')" required />
            <flux:select name="country" :label="__('Land')" wire:model.defer="country" required>
                @foreach($countries as $code => $name)
                    <flux:select.option value="{{ $code }}">{{ $name }}</flux:select.option>
                @endforeach
            </flux:select>
            <flux:input type="text" name="phone_number" :label="__('Telefoonnummer')" wire:model.defer="phone_number" :placeholder="__('Telefoonnummer')" required />
            <flux:input type="text" name="vat_number" :label="__('BTW Nummer')" wire:model.defer="vat_number" :placeholder="__('BTW Nummer')" />
            <div class="flex items-center justify-end">
                <flux:button type="submit" variant="primary" class="w-full" data-test="submit-invoice-details-button">
                    {{ __('Opslaan en Betalen') }}
                </flux:button>
            </div>
        </form>
</div>
