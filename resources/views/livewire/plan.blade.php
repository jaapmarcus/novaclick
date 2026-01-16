<div>
      <flux:heading size="xl" level="2">{{ __('Selecteer plan') }}</flux:heading>
        <flux:separator variant="subtle" class="mb-4" />
        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <h1 class="font-bold text-xl mb-4">Start</h1>
                <p class="mb-2 font-large">&euro; 50,- {{ __('per maand') }} {{__('Exclusief BTW')}}</p>
                <p>Voor ondernemers die alles rondom hun website netjes geregeld willen hebben, zonder gedoe.</p>
                <ul class="list-disc list-inside mt-2 space-y-1">
                    <li>Website ingericht voor lokale vindbaarheid</li>
                    <li>Duidelijke structuur die goed werkt voor lokale zoekopdrachten</li>
                    <li>Eenvoudig teksten en afbeeldingen aanpassen</li>
                    <li>Professionele uitstraling op desktop en mobiel</li>
                    <li>Vast maandbedrag, zonder hoge startkosten</li>
                </ul>
                <flux:button variant="primary" wire:click="selectPlan('start')" class="mt-4 w-full" data-test="select-start-plan-button">
                    {{ __('Selecteer Start Plan') }}
                </flux:button>
            </div>
            <div>
                <h1 class="font-bold text-xl mb-4">Automatisch</h1>
                <p class="mb-2 font-large">&euro; 75,- {{ __('per maand') }} {{__('Exclusief BTW')}}</p>
                <p>Voor ondernemers die ook taken en opvolging automatisch willen laten verlopen.</p>
                <ul class="list-disc list-inside mt-2 space-y-1">
                    <li>Alles uit het Start-pakket inbegrepen</li>
                    <li>Automatische opvolging van aanvragen en contactmomenten</li>
                    <li>Slimme koppelingen die handmatig werk verminderen</li>
                    <li>Snellere reacties richting potentiële klanten</li>
                    <li>Meedenken over online zichtbaarheid en marketing</li>
                </ul>
                <flux:button variant="primary" wire:click="selectPlan('automatisch')" class="mt-4 w-full" data-test="select-automatisch-plan-button">
                    {{ __('Selecteer Automatisch Plan') }}
                </flux:button>
            </div>
        </div>
</div>
