<div>
    <div class="flex flex-col">
        <flux:heading size="xl" level="2" class="mb-4">{{ __('Support') }} <flux:button class="float-right" wire:click="showCreateTicket()" variant="primary">{{ __('Nieuw Ticket') }}</flux:button></flux:heading>
        <flux:text size="md" class="mb-4 clear">{{ __('Bekijk en beheer uw support tickets hieronder. Klik op een ticket om de details te bekijken.') }} </flux:text>
        <flux:separator variant="subtle" class="mb-6 col-span-2" />
        <flux:modal wire:model="showCreateTicketForm" class=" w-full max-w-lg">
            <flux:heading size="lg" level="3" class="mb-4">{{ __('Nieuw Support Ticket Aanmaken') }}</flux:heading>
            <form wire:submit.prevent="createTicket" class="flex flex-col gap-4">
                <flux:input type="text" name="subject" :label="__('Onderwerp')" wire:model.defer="subject" :placeholder="__('Onderwerp van het ticket')" required />
                <flux:select name="department" :label="__('Afdeling')" wire:model.defer="department" required>
                    <flux:select.option value="">{{ __('Selecteer een afdeling') }}</flux:select.option>
                    <flux:select.option value="support">{{ __('Support') }}</flux:select.option>
                    <flux:select.option value="billing">{{ __('Facturatie') }}</flux:select.option>
                </flux:select>
                <flux:textarea name="message" :label="__('Bericht')" wire:model.defer="message" :placeholder="__('Beschrijf uw probleem of vraag hier')" required />
                <div class="flex items-center justify-end mt-4">
                    <flux:button type="submit" variant="primary">{{ __('Ticket Aanmaken') }}</flux:button>
                </div>
            </form>
        </flux:modal>
         <livewire:ticket-list />
        <flux:toast>

         </flux:toast>
    </div>
</div>
