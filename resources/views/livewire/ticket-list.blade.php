<div>
   @foreach( $this -> tickets() as $ticket )
       <div class="mb-4 p-4 border border-gray-200 rounded-lg">
           <div class="grid-cols-2 gap-4 md:grid">
                <div class="text-lg font-semibold flex">{{ $ticket -> subject }}</div>
                <div class="text-sm text-gray-600 flex justify-end">{{ \App\Models\User::find($ticket->user_id)->name }} {{ \App\Models\User::find($ticket->user_id)->last_name }}</div>
                <div class="col-span-2">
                    <div class="mt-2 text-gray-700">{{ nl2br($ticket -> message) }}</div>
                </div>
                <div class="col-span-2 text-sm text-gray-500 flex">{{ $ticket -> created_at -> format('d-m-Y H:i') }} </div>
                <div class="col-span-2 mt-4 flex justify-end"></div>
                @if($ticket -> response != null)
                    <div class="col-span-2 border-t border-gray-300 pt-4">
                        <div class="mt-2 text-gray-700">{{ nl2br($ticket -> response) }}</div>
                    </div>
                     <div class="text-sm text-gray-600 flex justify-left">Beantwoord door {{ \App\Models\User::find($ticket->assigned_to)->name }} {{ \App\Models\User::find($ticket->assigned_to)->last_name }}</div>
                    <div class="text-sm text-gray-500 flex justify-end">Responded at: {{ $ticket -> response_at -> format('d-m-Y H:i') }} </div>
                @endif
           </div>
       </div>
   @endforeach
</div>
