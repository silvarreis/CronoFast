<x-app-layout>
    @if($timeParts->isEmpty())
        <span class="col-12 not-found">
           ...
        </span> 
    @else
        <div class="col-12">
            <form action="{{ route('dash.search') }}" class="d-flex justify-content-center m-10" method="POST">
                <input type="text" class="input-search" size="40" name="search">
                <button class="btn-search" value="1">
                    <x-svgs.search w="21" h="21"/>
                </button>
            </form>
        </div>
        @foreach($timeParts as $grup => $timePart)
            @foreach($timePart as $ref => $items)
                <x-card col="6">
                
                    <x-card.header title="{{ $ref }}">
                        <p>%{{ $items[0]['margin'] }}</p>
                        <p><strong>{{ $grup }}</strong></p>
                    </x-card.header>
                    <x-card.body>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Maq.</th>
                                        <th>Operação</th>
                                        <th>CM</th>
                                        <th>%</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($items as $item)
                                        <tr>
                                            <td>{{ $item['employee'] }}</td>
                                            <td>{{ $item['machine'] }}</td>
                                            <td>{{ $item['operation'] }}</td> 
                                            <td>{{ $item['calcByEmployee'] }}</td>
                                            <td>{{ $item['production_pace'] }}</td>   
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="3">Total (minutos)</th>
                                        <th colspan="2">{{ number_format($totalCalcMargem[$ref][$grup], 2, ',', '.') }}</th>
                                    <tr>
                                </tfoot>
                            </table>
                    </x-card.body> 
                    <x-card.footer boxBtn="view" id="{{ $grup }}"/>
                   
                </x-card>
            @endforeach 
        @endforeach
    @endif
</x-app-layout>