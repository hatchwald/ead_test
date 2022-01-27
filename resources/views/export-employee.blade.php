<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title','Laravel')</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">

        <div class="container">
            <main class="py-4">
                <a href="#" class="btn btn-primary mb-4" id="exported_data_click">Export To Word</a>
                <div id="data_export_employee">
                    @foreach($data as $value)
                    <table class="table mb-4 table_employee_export" style="width: 100%;">
                        <thead style="background-color: gray;">
                            <tr class="table-secondary">

                                <th style="border: 1px solid black;padding: 8px;" scope="col">Field</th>
                                <th style="border: 1px solid black;padding: 8px;" scope="col">Value</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="border: 1px solid black;padding: 8px;">Nama</td>
                                <td style="border: 1px solid black;padding: 8px;">{{$value->nama}}</td>

                            </tr>
                            <tr>
                                <td style="border: 1px solid black;padding: 8px;">Jenis Kelamin</td>
                                <td style="border: 1px solid black;padding: 8px;">{{$value->jenis_kelamin}}</td>

                            </tr>
                            <tr>
                                <td style="border: 1px solid black;padding: 8px;">Nomor HP</td>
                                <td style="border: 1px solid black;padding: 8px;">{{$value->nomor_hp}}</td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid black;padding: 8px;">Email Aktif</td>
                                <td style="border: 1px solid black;padding: 8px;">{{$value->email}}</td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid black;padding: 8px;">Current Salary</td>
                                <td style="border: 1px solid black;padding: 8px;">{{number_format($value->current_salary,0,'','.')}}</td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid black;padding: 8px;">Foto Profil</td>
                                <td style="border: 1px solid black;padding: 8px;"><img src="./{{$value->foto_profil}}" class="img-tables" alt="" height="100px" width="100px"></td>
                            </tr>
                        </tbody>
                    </table>
                    @endforeach
                </div>


            </main>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{asset('plugins/js/fileSaver.js')}}"></script>
    <script type="text/javascript" src="{{asset('plugins/js/jquery.wordexport.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/export-data.js')}}"></script>
</body>

</html>