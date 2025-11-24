<div>
    <div class="mb-4 items-center justify-between">
    <flux:heading size="lg" level="2" class="mb-6">{{ __('Gebruikersbeheer') }}</flux:heading>
    <flux:separator variant="subtle" />
    <flux:table :paginate="$this->users">
        <flux:table.columns>
            <flux:table.column  sortable :sorted="$sortBy === 'id'" :direction="$sortDirection" wire:click="sort('id')">
                Id
            </flux:table.column>
            <flux:table.column   sortable :sorted="$sortBy === 'email'" :direction="$sortDirection" wire:click="sort('email')">
                Email
            </flux:table.column>
            <flux:table.column  sortable :sorted="$sortBy === 'domain'" :direction="$sortDirection" wire:click="sort('domain')">
               Domeinnaam
            </flux:table.column>
            <flux:table.column  sortable :sorted="$sortBy === 'created_at'" :direction="$sortDirection" wire:click="sort('created_at')">
                Aangemaakt op
            </flux:table.column>
            <flux:table.column></flux:table.column>
        </flux:table.columns>
        <flux:table.rows>
            @foreach($this->users as $user)
            <flux:table.row>
                <flux:table.cell>
                    {{ $user ->id }}
                </flux:table.cell>
                <flux:table.cell>
                    {{ $user ->email }}
                </flux:table.cell>
                <flux:table.cell>
                    {{ ucfirst($user ->domain) }}
                </flux:table.cell>
                <flux:table.cell>
                    {{ $user ->created_at->format('d-m-Y H:i') }}
                </flux:table.cell>
                <flux:table.cell>
                    <flux:button size="sm" variant="outline" href="{{ route('users.edit', $user->id) }}" variant="primary">{{ __('Bekijken') }}</flux:button>
                </flux:table.cell>
            </flux:table.row>
            @endforeach
        </flux:table.rows>
    </flux:table>

    </div>
</div>
