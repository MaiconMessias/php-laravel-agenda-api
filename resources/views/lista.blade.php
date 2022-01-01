<html>
<head>
    <title>Lista de Pessoas</title>
 
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    
</head>
<body>
 
<div class="container">
 
    <h1>Lista de pessoas</h1>
 
    <hr />
    <a href="{{url('/dados')}}" class="btn btn-primary mr-1">Incluir</a>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>Nome</th>
          <th>CPF</th>
          <th>Endereço</th>
          <th>Comandos</th>
        </tr>
      </thead>
      <tbody>
        @foreach($pessoas as $row)
        <tr>
          <th scope="row">{{ $row->id }}</th>
          <td>{{ $row->nome }}</td>
          <td>{{ $row->cpf }}</td>
          <td>{{ $row->endereco }}</td>
          <td>
            <a href="{{url('/editar/' . $row->id)}}" class="btn btn-primary mr-1">Editar</a>
            <a href="{{url('/deletar/' . $row->id)}}" class="btn btn-primary">Deletar</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  
</div>
 
</body>
</html>