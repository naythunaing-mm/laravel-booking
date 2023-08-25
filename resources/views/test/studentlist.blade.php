@foreach ($studentlist as $key => $value)
<p>{{ $key }} => {{ $value }}</p>
@endforeach
<hr> 
<h3>{{ $title }}</h3> 
<p>Name : {{ $hotel_setting->name }}</p>
<p>Email : {{ $hotel_setting->email }}</p>
<p>Address : {{ $hotel_setting->address }}</p>
<p>Online Phone : {{ $hotel_setting->online_phone }}</p>
<p>Outline Phone : {{ $hotel_setting->outline_phone }}</p>