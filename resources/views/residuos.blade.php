<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Resíduos</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="content">
            <h3 align="center">Import Excel de Resíduos</h3>
        </div>

        <br />
        @if(count($errors) > 0)
            <div class="alert alert-danger">
            Erro ao validar upload!<br><br>
            <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
            </ul>
            </div>
        @endif

        @if($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
        </div>
        @endif

        <form method="post" enctype="multipart/form-data"      action="{{ url('/residuos/import') }}">
            {{ csrf_field() }}
            <div class="form-group">
            <table class="table">
            <tr>
            <td width="40%" align="right"><label>Selecione arquivo para upload!</label></td>
            <td width="30">
                <input type="file" name="select_file" />
            </td>
            <td width="30%" align="left">
                <input type="submit" name="upload" class="btn btn-primary" value="Upload">
            </td>
            </tr>
            <tr>
            <td width="40%" align="right"></td>
            <td width="30"><span class="text-muted">.xls, .xslx</span></td>
            <td width="30%" align="left"></td>
            </tr>
            </table>
            </div>
        </form>

        <br />
        <div class="panel panel-default">
            <div class="panel-heading">
            <h3 class="panel-title">Resíduos</h3>
            </div>
        </div>

    <div class="panel-body">
     <div class="table-responsive">
      <table class="table table-bordered table-striped">
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Tipo</th>
        <th>Categoria</th>
        <th>Tecnologia de Tratamento</th>
        <th>Classe</th>
        <th>Unidade de Medida</th>
        <th>Peso</th>
       </tr>
       @foreach($data as $row)
       <tr>
        <td>{{ $row->id }}</td>
        <td>{{ $row->nome }}</td>
        <td>{{ $row->tipo }}</td>
        <td>{{ $row->categoria }}</td>
        <td>{{ $row->tecnologia_tratamento }}</td>
        <td>{{ $row->classe }}</td>
        <td>{{ $row->un }}</td>
        <td>{{ $row->peso }}</td>
       </tr>
       @endforeach
       </table>
     </div>
    </div>
 </body>
</html>