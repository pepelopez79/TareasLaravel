<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Tareas</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        img {
            max-width: 100px;
        }
    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Título</th>
                <th>Contenido</th>
                <th>Categoría</th>
                <th>Prioridad</th> 
                <th>Lugar</th> 
                <th>Estado</th>
                <th>Fecha de Creación</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tareas as $tarea)
            <tr>
                <td>{{ $tarea->titulo }}</td>
                <td>{{ $tarea->contenido }}</td>
                <td>{{ $tarea->prioridad }}</td>
                <td>{{ $tarea->lugar }}</td>
                <td>{{ $tarea->estado }}</td>
                <td>{{ $tarea->categoria->nombre }}</td>
                <td>{{ $tarea->created_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>
