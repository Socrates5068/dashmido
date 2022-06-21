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

    <title>Especialidades</title>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
</head>

<body class="login-page" style="background: white">

    <div>
        <div class="text-center">
            <h3>Especialidades</h3>
        </div>
        <hr>

        <div class="h-25">
            <table class="table table-bordered" style="width: 100%">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">
                            Especialidad
                        </th>
                        <th class="whitespace-nowrap">
                            Médicos
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($departments as $department)
                        <tr>
                            <td>
                                {{ $department->name }}
                            </td>
                            <td>
                                @foreach ($department->staff as $staff)
                                    <ul>{{ $staff->person->name }}
                                        {{ $staff->person->f_last_name }}
                                        {{ $staff->person->m_last_name }}
                                    </ul>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
</body>

</html>
