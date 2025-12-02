<div>
    <flux:heading size="xl" level="2">Veel gestelde vragen</flux:heading>
    <flux:text class="mt-2">Hieronder vind je een overzicht van de veelgestelde vragen. Als je jouw vraag hier niet kunt vinden, neem dan gerust contact met ons op via het supportformulier.</flux:text>
    <flux:separator variant="subtle" class="mb-6" />

    @foreach($this -> categoryList() as $category)
        <flux:heading size="lg" level="3" class="mt-6">{{ $category->name }}</flux:heading>
        <flux:text>{{ $category->description }}</flux:text>
        <flux:separator variant="subtle" class="mb-4" />
        <flux:accordion>
            @foreach($this->faqs($category->id) as $faq)
                <flux:accordion.item>
                <flux:accordion.heading>{!! nl2br($faq->question) !!}</flux:accordion.heading>
                <flux:accordion.content>
                    {!! nl2br($faq->answer) !!}
                </flux:accordion.content>
            </flux:accordion.item>
            @endforeach
        </flux:accordion>
    @endforeach

</div>
