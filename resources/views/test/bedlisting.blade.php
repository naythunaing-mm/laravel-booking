<!DOCTYPE html>
<html>
<head>
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
</style>
</head>
<body>

<h1>A Fancy Table</h1>
@if(session('success'))
@endif
<table id="customers">
  <tr>
    <th>Id</th>
    <th>Name</th>
    <th>Action</th>
  </tr>
  @foreach ($bed_data as $bed )
  <tr>
    <td>{{ $bed->id }}</td>
    <td>{{ $bed->name }}</td>
    <td>
        <a href="{{ URL::to('/bed/edit') }}/{{ $bed->id }}">Edit</a>
        <a href="{{ URL::to('/bed/delete') }}/{{ $bed->id }}">Delete</a>
    </td>
  </tr>
  @endforeach
 

</table>

</body>
</html>


