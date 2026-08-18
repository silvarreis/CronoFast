<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhe</title>
</head>
<style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
    }
    body {
        margin-left: 20px;
        margin-right: 20px;
    }
    
    nav {
        display:flex;
        align-items: center;
        justify-content:space-between;
        padding: 20px 0;
    }
    a {
        background-color: #0b1f3A;
        color: #FFFFFF;
        padding: 10px 15px;
        font-size: 16px;
        border-radius: 3px;
        border: none;
        cursor: pointer;
        text-decoration: none;
        text-align: center;
    }
    .lap-number{ background-color: #0b1f3A; color: #FFFFFF}
    a:hover { background: linear-gradient(90deg, #0b1f3A, #1E5EFF);}

    table {
        text-align: center;
        width: 100%;
        border-collapse: separate !important; 
        border-spacing: 0 !important; 
        font-size: 1rem;
        border-top: 1px solid #d2d2d2 !important;
        border-left: 1px solid #d2d2d2  !important;
        border-bottom: 1px solid #d2d2d2  !important;
        border-right: 1px solid #d2d2d2  !important;
    }  
    th, td {
        border: 1px solid #d2d2d2;
        padding: 5px 2px;
        break-inside: avoid;
    }
    .delete {
        background-color: #dc3545;
        border: 2px solid #dc3545;
        cursor: pointer;
        padding: 2px 5px;
        color: #FFFFFF;
        border-radius: 2px 5px;
        font-size: 14px;
    }
    .container {
        width: 100%;
        display: flex;
        gap:10px;
        
    }
    .card {
        display: inline-block;
        vertical-align: top;
        width: 20%;
    
        text-align: left;
        background-color: #FFFFFF;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    .card .header {
        padding:  0.5em;
        border-bottom: 1px solid #0b1f3A58;
        text-align: center;
    }
    .card .header .title {
        font-weight: bold;
        font-size: 18px;
        margin-bottom: 5px;
    }
    .card .body {
        max-height: 410px;
        overflow: auto;
        scrollbar-width: thin;
    }
    .card .body table {
        margin:2px auto;
        width: 98%;
    }
    @media (max-width: 835px) {
        .container {
            flex-direction:column;
        }
        .card {
            width: 100%;
        }
        nav {
            gap: 8px;
        }
        body {
            margin-left: 5px;
            margin-right: 5px;
        }
    }
</style>
<body>
    @foreach($timeParts as $grup => $timePart)
        <nav>
            @foreach($timePart as $ref => $items)
                <div>
                    <h3>{{$grup}} - {{$ref}}</h3>
                    <p>{{ $dataHoraBr }}</p>
                </div>
            @endforeach
            @if(!$isPdf)
                <a href="/dashboard">Voltar</a>
                <a id="btn-pdf" href="{{ request()->url() }}?pdf=1">SALVAR EM PDF</a>
            @endif
        </nav>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Maq.</th>
                    <th>Operação</th>
                    <th>CM</th>
                    <th>%</th>
                    @if(!$isPdf)
                        <th>Ação</th>
                    @endif
                </tr>
            </thead>
                <tbody>
                    @foreach($items as $item)
                        <tr id="{{ $item['id'] }}">
                            <td>{{ $item['employee'] }}</td>
                            <td>{{ $item['machine'] }}</td>
                            <td>{{ $item['operation'] }}</td> 
                            <td>{{ $item['calcByEmployee'] }}</td>
                            <td>{{ $item['production_pace'] }}</td>
                            @if(!$isPdf)
                                <td>
                                    <button class="delete" data-delete="{{ $item['id'] }}">
                                        Excluir
                                    </button>
                                </td>
                            @endif
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
        <br>
        <br>
        <div class="container">
            @foreach($items as $data)
                <div class="card card-{{ $data['id'] }}">
                    <div class="header">
                        <p class="title">{{ $data['employee'] }}</p>
                        <p>{{ $data['machine'] }}</p>
                    </div>
                    <div class="body">
                        <table>
                            @foreach($data['lap'] as $dt)
                                <tr id="time-{{ $dt['id'] }}">
                                    <td class="lap-number">{{ $dt['lap_number'] }}</td>
                                    <td>{{ $dt['lap_time'] }}</td>
                                    @if(!$isPdf)
                                        <td>
                                            <button class="delete" data-delete-time="{{ $dt['id'] }}">
                                                Excluir
                                            </button>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </table> 
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
    @vite(['resources/js/app.js', 'resources/js/bootstrap.js'])
</body>
</html>