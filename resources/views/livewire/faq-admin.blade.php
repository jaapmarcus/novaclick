<div>
   <flux:heading size="xl" level="2">Veelgestelde Vragen Beheer</flux:heading>
        <flux:separator variant="subtle" class="mb-6" />
    <flux:table>
        <flux:table.columns>
            <flux:table.column>
                Vraag
            </flux:table.column>
            <flux:table.column>
                Antwoord
            </flux:table.column>
            <flux:table.column>
                Categorie
            </flux:table.column>
            <flux:table.column>
                Volgorde
            </flux:table.column>
            <flux:table.column>
                Acties
            </flux:table.column>
        </flux:table.columns>
        <flux:table.rows>
            @foreach($this -> faqs as $faq)
            <flux:table.row>
                <flux:table.cell>
                    {{ $faq -> question }}
                </flux:table.cell>
                <flux:table.cell class="truncate max-w-sm">
                    {{ $faq -> answer }}
                </flux:table.cell>
                <flux:table.cell>
                    {{ $faq -> category_id ? App\Models\Category::find($faq -> category_id)?->name : 'Onbekend' }}
                </flux:table.cell>
                <flux:table.cell>
                    {{ $faq -> order }}
                </flux:table.cell>
                <flux:table.cell>
                    <flux:button size="sm" variant="primary" wire:click="editFaq({{ $faq->id }})">{{ __('Bewerken') }}</flux:button>
                    <flux:button size="sm" variant="danger" wire:click="confirmDelete({{ $faq->id }})">{{ __('Verwijderen') }}</flux:button>
                </flux:table.cell>
            </flux:table.row>
            @endforeach
        </flux:table.rows>
    </flux:table>
    <flux:modal wire:model="showDeleteConfirmation" title="Bevestig Verwijdering">
        @if($faqToDelete != null)
        <flux:text>Weet je zeker dat je de vraag "{{ $faqToDelete->question }}" wilt verwijderen? Dit kan niet ongedaan worden gemaakt.</flux:text>
        <flux:separator variant="subtle" class="my-4" />
        <div class="flex justify-end gap-2">
        <flux:button variant="outline" wire:click="cancelDelete">{{ __('Annuleren') }}</flux:button>
        <flux:button variant="danger" wire:click="deleteFaq({{ $faqToDelete->id }})">{{ __('Verwijderen') }}</flux:button>
        </div>
        @endif
    </flux:modal>
    <flux:modal wire:model="showEditModal" title="FAQ Bewerken">
        <form wire:submit.prevent="updateFaq({{ $faqToEdit?->id }})" class="gap-2 mt-4 flex flex-col">
            <flux:input
                label="Vraag"
                placeholder="Voer de veelgestelde vraag in"
                wire:model="editquestion"
                required
            />
            <flux:textarea
                label="Antwoord"
                placeholder="Voer het antwoord op de veelgestelde vraag in"
                wire:model="editanswer"
                required
            />
            <flux:select label="Categorie" wire:model="editcategory_id" required>
                <flux:select.option value="">{{ __('Selecteer een categorie') }}</flux:select.option>
                @foreach(App\Models\Category::all() as $cat)
                    <flux:select.option :value="$cat->id">{{ $cat->name }}</flux:select.option>
                @endforeach
            </flux:select>
            <flux:input
                label="Volgorde"
                type="number"
                placeholder="Voer de volgorde in"
                wire:model="editorder"
                min="0"
            />
            <div class="flex justify-end gap-2 mt-4">
                <flux:button variant="outline" wire:click="$set('showEditModal', false)">{{ __('Annuleren') }}</flux:button>
                <flux:button type="submit" variant="primary">FAQ Bijwerken</flux:button>
            </div>
        </form>
    </flux:modal>
    <flux:heading size="xl" level="2" class="mt-8">Nieuwe FAQ Aanmaken</flux:heading>
        <flux:separator variant="subtle" class="mb-6" />
    <form wire:submit.prevent="addFaq" class="gap-2 mt-4 flex flex-col">
        <flux:input
            label="Vraag"
            placeholder="Voer de veelgestelde vraag in"
            wire:model="question"
            required
        />
        <flux:textarea
            label="Antwoord"
            placeholder="Voer het antwoord op de veelgestelde vraag in"
            wire:model="answer"
            required
        />
        <flux:select label="Categorie" wire:model="category_id" required>
            <flux:select.option value="">{{ __('Selecteer een categorie') }}</flux:select.option>
            @foreach(App\Models\Category::all() as $cat)
                <flux:select.option :value="$cat->id">{{ $cat->name }}</flux:select.option>
            @endforeach
        </flux:select>
        <flux:input
            label="Volgorde"
            type="number"
            placeholder="Voer de volgorde in"
            wire:model="order"
            min="0"
        />
        <div class="flex items-center justify-end">
            <flux:button type="submit" variant="primary" class="w-full" data-test="submit-faq-button">
                {{ __('FAQ Aanmaken') }}
            </flux:button>
        </div>
    </form>
    @if(session('message'))
    <flux:toast>
    {{ session('message') }}
    </flux:toast>
    @endif
</div>
