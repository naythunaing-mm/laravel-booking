<!DOCTYPE html>
<html>
<style>
input[type=text], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  width: 100%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

div {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}
</style>
<body>

<h3>Using CSS to style an HTML Form</h3>

<div>
  @if (isset($view_data))
    <form action="{{ route('ViewUpdate') }}" method="POST">
  @else
  <form action="{{ route('createView') }}" method="POST">
  @endif
  
    @csrf
    <label for="fname">Name</label>
    <input type="text" id="fname" name="name" placeholder="Your name.." value="{{ old('name',isset($view_data)? $view_data->name:'') }}">
    @if($errors->has('name'))
    <p style="color:red">{{ $errors->first('name') }}</p>
    @endif
    @if (isset($view_data))
        <input type="hidden" name="id" value="{{ $view_data->id }}">
    @endif
    <input type="submit" value="Submit">
  </form>
</div>

</body>
</html>


