<div>
    <flux:heading size="xl" level="2">Categorieën Beheren</flux:heading>
    <flux:text class="mt-2">Hieronder kun je categorieën toevoegen, bewerken of verwijderen voor je FAQ-secties.</flux:text>
    <flux:separator variant="subtle" class="mb-6" />
        <flux:table>
        <flux:table.columns>
            <flux:table.column>Naam</flux:table.column>
            <flux:table.column>Beschrijving</flux:table.column>
            <flux:table.column>Volgorde</flux:table.column>
            <flux:table.column></flux:table.column>
        </flux:table.columns>
        <flux:table.rows>
            @foreach($this->categories() as $category)
            <flux:table.row>
                <flux:table.cell>{{ $category->name }}</flux:table.cell>
                <flux:table.cell>{{ $category->description }}</flux:table.cell>
                <flux:table.cell>{{ $category->order }}</flux:table.cell>
                <flux:table.cell>
                    <flux:button size="sm" variant="primary" wire:click="editCategory({{ $category->id }})">{{ __('Bewerken') }}</flux:button>
                    <flux:button size="sm" variant="danger" wire:click="confirmDelete({{ $category->id }})">{{ __('Verwijderen') }}</flux:button>

                    <flux:modal wire:model="showDeleteConfirmation" title="Bevestig Verwijdering">
                        <flux:text>Weet je zeker dat je de categorie "{{ $categoryToDelete?->name }}" wilt verwijderen? Dit kan niet ongedaan worden gemaakt.</flux:text>
                        <flux:separator variant="subtle" class="my-4" />
                        <div class="flex justify-end gap-2">
                            <flux:button variant="outline" wire:click="cancelDelete">{{ __('Annuleren') }}</flux:button>
                            <flux:button variant="danger" wire:click="deleteCategoryConfirmed">{{ __('Verwijderen') }}</flux:button>
                        </div>
                    </flux:modal>
                </flux:table.cell>
            </flux:table.row>
            @endforeach
        </flux:table.rows>
    </flux:table>
    <flux:modal wire:model="showEditModal" title="Categorie Bewerken">
        <form wire:submit.prevent="updateCategory({{ $categoryToEdit?->id }})" class="gap-2 mt-4 flex flex-col">
            <flux:input
                label="Naam"
                placeholder="Voer de categorienaam in"
                wire:model="editname"
                required
            />
            <flux:textarea
                label="Beschrijving"
                placeholder="Voer een korte beschrijving in"
                wire:model="editdescription"
            />
            <flux:input
                label="Volgorde"
                type="number"
                placeholder="Voer de volgorde in"
                wire:model="editorder"
                min="0"
            />
            <div class="flex justify-end gap-2 mt-4">
                <flux:button variant="outline" wire:click="$set('showEditModal', false)">{{ __('Annuleren') }}</flux:button>
                <flux:button type="submit" variant="primary">Categorie Bijwerken</flux:button>
            </div>
        </form>
    </flux:modal>
    <form wire:submit.prevent="addCategory" class="gap-2 mt-4 flex flex-col">
        <flux:heading size="xl" level="2">Categorieën aanmaken</flux:heading>
        <flux:separator variant="subtle" class="mb-2" />
        @if(session()->has('message'))
            <fux:toast variant="success" class="mb-4">
                {{ session('message') }}
            </fux:toast>
        @endif
        <flux:input
            label="Naam"
            placeholder="Voer de categorienaam in"
            wire:model="name"
            required
        />
        <flux:input
            label="Beschrijving"
            placeholder="Voer een korte beschrijving in"
            wire:model="description"
        />
        <flux:input
            label="Volgorde"
            type="number"
            placeholder="Voer de volgorde in"
            wire:model="order"
            min="0"
        />
        <flux:button type="submit" class="mt-4" variant="primary">Categorie Toevoegen</flux:button>
    </form>


</div>
