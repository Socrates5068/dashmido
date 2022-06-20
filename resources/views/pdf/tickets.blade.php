@php
use App\Models\Department;
use App\Models\Person;
use App\Models\Patient;
use App\Models\Staff;
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">

    <title>Receta</title>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
</head>

<body class="login-page" style="background: white">

    <div>
        <div class="text-center">
            <h3>Fichaje {{ $departmentName }}</h3>
        </div>
        <hr>

        <div class="h-25">
            <table class="table table-bordered" style="width: 100%">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">
                            Fecha
                        </th>
                        <th class="whitespace-nowrap">
                            Hora

                        </th>
                        <th class="whitespace-nowrap">
                            Paciente
                        </th>
                        <th class="whitespace-nowrap">
                            Estado
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tickets as $ticket)
                        <tr>
                            <td class="border">
                                {{ $ticket->date }}
                            </td>
                            <td>
                                {{ $ticket->time }}
                            </td>
                            <td>
                                @isset($ticket->patient_id)
                                    {{ Patient::find($ticket->patient_id)->person->name }}
                                    {{ Patient::find($ticket->patient_id)->person->f_last_name }}
                                    {{ Patient::find($ticket->patient_id)->person->m_last_name }}
                                @endisset
                            </td>
                            <td>
                                @if ($ticket->status == '0')
                                    Sin reservar
                                @elseif($ticket->status == '1')
                                    Pendiente
                                @elseif($ticket->status == '2')
                                    En atención
                                @elseif($ticket->status == '3')
                                    Atendido
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <hr>

        <div class="row">
            <div class="">
                <table style="width: 100%">
                    <tbody>
                        <tr class="well" style="padding: 5px">
                            <th style="padding: 5px">
                                <div> Médico encargado: </div>
                            </th>
                            <td style="padding: 5px" class="text-right">
                                    {{ Staff::find($staffId)->person->name }}
                                    {{ Staff::find($staffId)->person->f_last_name }}
                                    {{ Staff::find($staffId)->person->m_last_name }}
                            </td>
                            <th style="padding: 5px">
                                <div> Ficha generada el día: </div>
                            </th>
                            <td style="padding: 5px" class="text-right">
                                    {{ date('d-m-Y', strtotime(now()) ) }}
                                    {{ 'a horas '. date('H:i:s', strtotime(now()) ) }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>
