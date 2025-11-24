<div>
    <flux:heading size="xl" level="2">{{ __('Onboarding Intake') }}</flux:heading>
    <flux:separator variant="subtle" />

    @if($step == 1)
    <form wire:submit.prevent="nextStep" class="flex flex-col gap-6 mt-4" x-data="{ logo_upload:false, file_upload:false }">
        <flux:heading size="lg" level="3" class="mt-6">{{ __('Stap 1: Domeinaam') }}</flux:heading>
        <flux:separator variant="subtle" />
        <flux:select type="text" name="website_present" :label="__('Heeft u al een website?')" wire:model.defer="website_present">
            <flux:select.option value="">{{ __('Selecteer een optie') }}</flux:select.option>
            <flux:select.option value="yes">{{ __('Ja') }}</flux:select.option>
            <flux:select.option value="no">{{ __('Nee') }}</flux:select.option>
        </flux:select>
        <flux:input.group label="{{ __('Website domeinnaam') }}">
            <flux:input type="text" name="domain_name"  wire:model.defer="domain_name" :placeholder="__('mijn-website.nl')" wire:change="whois" spellcheck="false" autocomplete="off"/>
            <flux:button variant="primary" wire:click="whois">{{ __('Controleer beschikbaarheid') }}</flux:button>
        </flux:input.group>
        @if($website_available === false)
            <div class="text-sm bg-red-100 text-red-800 p-3 rounded-md">
                {{ __('De door u opgegeven domeinnaam is niet beschikbaar. Indien u de domeinnaam wilt overzetten, vul dan de verhuis token in of kies een andere domeinaam') }}
            </div>
            <flux:input type="text" name="transfer_token" :label="__('Wat is de verhuis token?')" wire:model.defer="transfer_token" :placeholder="__('Verhuis token')"  spellcheck="false" autocomplete="off"/>
        @elseif($website_available === true)
            <div class="text-sm bg-green-100 text-green-800 p-3 rounded-md">
                {{ __('De door u opgegeven domeinnaam is beschikbaar.') }}
            </div>
        @elseif($website_available === 'not_allowed')
            <div class="text-sm bg-yellow-100 text-yellow-800 p-3 rounded-md">
                {{ __('De door u opgegeven domeinnaam heeft een extensie die wij niet ondersteunen. Ondersteunde extensies zijn: .nl, .be, .com, .eu, .de, .fr, .org, .it, .ch, .at') }}
            </div>
        @endif
        <flux:button type="submit" variant="primary" class="self-end mt-6">{{ __('Volgende stap') }}</flux:button>
    </form>
    @elseif($step == 2)
    <form wire:submit.prevent="nextStep" class="flex flex-col gap-6 mt-4"  x-data="{ places_search_check:false }">
        <flux:heading size="lg" level="3" class="mt-6">{{ __('Stap 2: Google Places') }}</flux:heading>
        <flux:separator variant="subtle" />
        <flux:select type="text" name="has_places" :label="__('Heeft u een Google Mijn Bedrijf vermelding?')" wire:model.defer="has_places" wire:change="placeSearch" x-on:change="places_search_check = $event.target.value === 'yes' ? true : false">
            <flux:select.option value="">{{ __('Selecteer een optie') }}</flux:select.option>
            <flux:select.option value="yes">{{ __('Ja') }}</flux:select.option>
            <flux:select.option value="no">{{ __('Nee') }}</flux:select.option>
        </flux:select>
        <div x-show="places_search_check" x-transition">
            <p class="mb-4">{{ __('Zoek uw bedrijf op naam en selecteer de juiste vermelding uit de lijst') }}</p>
            <flux:input.group label="{{ __('Zoek uw bedrijf op naam') }}" >
            <flux:input type="text" name="search_text" wire:model.defer="search_text" wire:change="placeSearch" spellcheck="false" autocomplete="off" />
            <flux:button variant="primary" wire:click="placeSearch">{{ __('Zoek vermelding') }}</flux:button>
            </flux:input.group>
            <flux:select type="text" name="place_id" :label="__('Selecteer uw bedrijf')" wire:model.defer="place_id">
                <flux:select.option value="">{{ __('Selecteer een optie') }}</flux:select.option>
                @if(!empty($places))
                    @foreach($places as $place)
                        <flux:select.option value="{{ $place['place_id'] }}">{{ $place['name'] }} - {{ $place['formatted_address'] }}</flux:select.option>
                    @endforeach
                @endif
            </flux:select>
        </div>
        <flux:button type="submit" variant="primary" class="self-end mt-6">{{ __('Volgende stap') }}</flux:button>
    </form>
    @elseif($step == 3)
    <form wire:submit.prevent="nextStep" class="flex flex-col gap-6 mt-4" x-data="{ logo_upload:false }">
        <flux:heading size="lg" level="3" class="mt-6">{{ __('Stap 3: Upload uw logo') }}</flux:heading>
        <flux:separator variant="subtle" />
        <flux:select name="logo_available" :label="__('Heeft u een logo voor uw website?')" wire:model.defer="logo_available"  x-on:change="logo_upload = ( $event.target.value === 'yes' )">
            <flux:select.option value="">{{ __('Selecteer een optie') }}</flux:select.option>
            <flux:select.option value="yes">{{ __('Ja') }}</flux:select.option>
            <flux:select.option value="no">{{ __('Nee') }}</flux:select.option>
        </flux:select>
        <div id="logo-upload" x-show="logo_upload === true" x-transition>
            <flux:file-upload wire:model="logo" multiple label="Upload Logo's">
                <flux:file-upload.dropzone
                    heading="Drop de bestanden hier of klik om te uploaden"
                    text="JPG, PNG, SVG tot maximaal 10MB"
                    with-progress
                    inline
                    multiple
                />
            </flux:file-upload>
            <div class="mt-4 flex flex-col gap-2">
                @foreach ($logo as $logoFile)
                    <div class="flex items-center gap-4">
                        <flux:text>{{ $logoFile->getClientOriginalName() }}</flux:text>
                        <flux:text class="text-sm text-neutral-500">{{ number_format($logoFile->getSize() / 1024, 2) }} KB</flux:text>
                        <flux:file-item.remove wire:click="removeLogo('{{ $logoFile->getClientOriginalName() }}')" />
                    </div>
                @endforeach
            </div>
        </div>
        <flux:button type="submit" variant="primary" class="self-end mt-6">{{ __('Volgende stap') }}</flux:button>
    </form>
    @elseif($step == 4)
    <form wire:submit.prevent="nextStep" class="flex flex-col gap-6 mt-4">
        <flux:heading size="lg" level="3" class="mt-6">{{ __('Stap 4: Kleur schema') }}</flux:heading>
        <flux:separator variant="subtle" />
        <flux:input.group label="{{__('Tekst kleur')}}" class="w-xs">
            <flux:input type="text" name="text_color" id="text_color" wire:model.defer="text_color" x-data="{}" />
            <flux:input type="color" name="text_color_picker" wire:model.defer="text_color_picker" x-on:change="document.getElementById('text_color').value = $event.target.value" class="w-3xs"/>
        </flux:input.group>
        <flux:input.group label="{{__('Achtergrond kleur')}}" class="w-xs">
            <flux:input type="text" name="background_color" id="background_color" wire:model.defer="background_color" x-data="{}"/>
            <flux:input type="color" name="background_color_picker" wire:model.defer="background_color_picker" x-on:change="document.getElementById('background_color').value = $event.target.value" class="w-3xs"/>
        </flux:input.group>
        <flux:input.group label="{{__('Primaire kleur')}}" class="w-xs">
            <flux:input type="text" name="primary_color" id="primary_color" wire:model.defer="primary_color" x-data="{}"/>
            <flux:input type="color" name="primary_color_picker" wire:model.defer="primary_color_picker" x-on:change="document.getElementById('primary_color').value = $event.target.value" class="w-3xs"/>
        </flux:input.group>
        <flux:button type="submit" variant="primary" class="self-end mt-6">{{ __('Volgende stap') }}</flux:button>
    </form>
    @elseif($step == 5)
    <form wire:submit.prevent="nextStep" class="flex flex-col gap-6 mt-4">
        <flux:heading size="lg" level="3" class="mt-6">{{ __('Website Informatie') }}</flux:heading>
        <flux:separator variant="subtle" />
<flux:textarea name="additional_info" :label="__('Welke informatie over het bedrijf moet worden meegenomen?')" wire:model.defer="additional_info" :placeholder="__('Vul hier eventuele aanvullende informatie in...')" />
        <flux:textarea name="services_offered" :label="__('Welke diensten bied je aan?')" wire:model.defer="services_offered" :placeholder="__('Vul hier de diensten in die je aanbiedt...')" />
        <flux:textarea name="target_audience" :label="__('Wat is de doelgroep van de website?')" wire:model.defer="target_audience" :placeholder="__('Vul hier de doelgroep in...')" />
        <flux:textarea name="website_goals" :label="__('Wat wil je dat bezoekers doen op de website?')" wire:model.defer="website_goals" :placeholder="__('Vul hier de doelen van de website in...')" />
        <flux:textarea name="desired_pages" :label="__('Welke pagina’s wil je op de site? (maximaal acht)')" wire:model.defer="desired_pages" :placeholder="__('Bijv. Home, Over ons, Diensten, Contact...')" />
        <flux:textarea name="contact_form" :label="__('Welke velden moeten er in het contactformulier komen?')" wire:model.defer="contact_form" :placeholder="__('Bijv. Naam, E-mail, Bericht...')" />
        <flux:button type="submit" variant="primary" class="self-end mt-6">{{ __('Volgende stap') }}</flux:button>
    </form>
    @elseif($step == 6)
    <form wire:submit.prevent="SaveWizard" class="flex flex-col gap-6 mt-4" x-data="{ file_upload:false }">
    <flux:heading size="lg" level="3" class="mt-6">{{ __('Stap 6: Upload bestanden') }}</flux:heading>
    <flux:separator variant="subtle" />
    <flux:select name="text_images" :label="__('Heb je al teksten en afbeeldingen voor de website?')" wire:model.defer="text_images" x-on:change="file_upload = ( $event.target.value === 'yes' )">
            <flux:select.option value="">{{ __('Selecteer een optie') }}</flux:select.option>
            <flux:select.option value="yes">{{ __('Ja') }}</flux:select.option>
            <flux:select.option value="no">{{ __('Nee') }}</flux:select.option>
        </flux:select>
        <div id="file-upload" x-show="file_upload === true">
             <flux:textarea name="teksten" :label="__('Deel een je Dropbox link / Google Docs of Google Drive link')" wire:model.defer="teksten"  />
            <flux:file-upload wire:model="files" multiple label="Upload Bestanden">
                <flux:file-upload.dropzone
                    heading="Drop de bestanden hier of klik om te uploaden"
                    text="JPG, PNG, DOC, TXT, PDF tot maximaal 10MB"
                    with-progress
                    inline
                    multiple
                />
            </flux:file-upload>
            <div class="mt-4 flex flex-col gap-2">
                @foreach ($files as $uploadedFile)
                    <div class="flex items-center gap-4">
                        <flux:text>{{ $uploadedFile->getClientOriginalName() }}</flux:text>
                        <flux:text class="text-sm text-neutral-500">{{ number_format($uploadedFile->getSize() / 1024, 2) }} KB</flux:text>
                        <flux:file-item.remove wire:click="removeFile('{{ $uploadedFile->getClientOriginalName() }}')" />
                    </div>
                @endforeach
            </div>
        </div>
        <flux:button type="submit" variant="primary" class="self-end mt-6">{{ __('Onboarding voltooien') }}</flux:button>
    </form>
    @elseif($step == 7)
    <flux:heading size="lg" level="3" class="mt-6">{{ __('Onboarding voltooid!') }}</flux:heading>
    <flux:separator variant="subtle" />
    <div class="mt-4 space-y-4">
        <flux:text>{{ __('Bedankt voor het invullen van de onboarding intake. Hieronder vindt u een overzicht van de door u verstrekte informatie:') }}</flux:text>
        <flux:heading size="md" level="4">{{ __('Domeinnaam') }}</flux:heading>
        <flux:text>{{ $domain_name }}</flux:text>
            @if($transfer_token)
            <flux:text>Verhuis Token: {{ $transfer_token }}</flux:text>
            @endif

        <flux:heading size="md" level="4">{{ __('Google Mijn Bedrijf Vermelding') }}</flux:heading>
        <flux:text>
            @if($has_places === 'yes' && !empty($places))
                @foreach($places as $place)
                    @if($place['place_id'] === $place_id)
                        {{ $place['name'] }} - {{ $place['formatted_address'] }}
                    @endif
                @endforeach
            @else
                {{ __('Geen vermelding geselecteerd') }}
            @endif
        </flux:text>

        <flux:heading size="md" level="4">{{ __('Website Informatie') }}</flux:heading>
        <flux:text>Welke informatie over het bedrijf moet worden meegenomen?<br /> {{ $additional_info }}</flux:text>
        <flux:text>Welke diensten bied je aan?<br />{{ $services_offered }}</flux:text>
        <flux:text>Wat is de doelgroep van de website?<br />
        {{ $target_audience }}</flux:text>
        <flux:text>Wat wil je dat bezoekers doen op de website?<br />
        {{ $website_goals }}</flux:text>
        <flux:text>Welke pagina’s wil je op de site? (maximaal acht)?<br />
        {{ $desired_pages }}</flux:text>
        <flux:text>Welke velden moeten er in het contactformulier komen?:<br />
        {{ $contact_form }}</flux:text>

        <flux:heading size="md" level="4">{{ __('Kleur Schema') }}</flux:heading>
        <flux:text>{{ __('Tekst kleur:') }} {{ $text_color }}</flux:text>
        <flux:text>{{ __('Achtergrond kleur:') }} {{ $background_color }}</flux:text>
        <flux:text>{{ __('Primaire kleur:') }} {{ $primary_color }}</flux:text>

        <flux:heading size="md" level="4">{{ __('Geüploade Bestanden') }}</flux:heading>
        <div class="mt-4 flex flex-col gap-2">
            @foreach ($logo as $logoFile)
                <div class="flex items-center gap-4">
                    <flux:text>{{ $logoFile->getClientOriginalName() }}</flux:text>
                    <flux:text class="text-sm text-neutral-500">{{ number_format($logoFile->getSize() / 1024, 2) }} KB</flux:text>
                </div>
            @endforeach
        </div>
        <div class="mt-4 flex flex-col gap-2">
            @foreach ($files as $uploadedFile)
                <div class="flex items-center gap-4">
                    <flux:text>{{ $uploadedFile->getClientOriginalName() }}</flux:text>
                    <flux:text class="text-sm text-neutral-500">{{ number_format($uploadedFile->getSize() / 1024, 2) }} KB</flux:text>
                </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
