<x-app-layout>
    @if($timeParts->isEmpty())
        <span class="col-12 not-found">
           ...
        </span> 
    @else
        <div class="col-12">
            <form action="{{-- route('operation.show') --}}" class="d-flex justify-content-center m-10" method="get">
                <input type="text" class="input-search" size="40">
                <button class="btn-search" value="1">
                    <x-svgs.search w="21" h="21"/>
                </button>
            </form>
        </div>
        @foreach($timeParts as $grup => $timePart)
            @foreach($timePart as $ref => $items)
                <x-card col="4">
                
                    <x-card.header title="{{ $ref }}">
                        <p>%{{ $items[0]['margin'] }}</p>
                        <p><strong>{{ $grup }}</strong></p>
                    </x-card.header>
                    <x-card.body>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Operação</th>
                                        <th>Valor</th>
                                        <th>%</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($items as $item)
                                        <tr>
                                            <td>{{ $item['employee'] }}</td>
                                            <td>{{ $item['operation'] }}</td> 
                                            <td>{{ $item['calcByEmployee'] }}</td>
                                            <td>{{ $item['production_pace'] }}</td>   
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="2">Total (minutos)</th>
                                        <th colspan="4">{{ number_format($totalCalcMargem[$ref][$grup], 2, ',', '.') }}</th>
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