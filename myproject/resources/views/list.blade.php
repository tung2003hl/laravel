<h1>List Sinhvien<h1>

<table border='1'>
    <tr>
        <td>ID</td>
        <td>Ten</td>
        <td>Tuoi</td>
        <td>Diem</td>
    </tr>
    @foreach($sinhviens as $sinhvien)
    <tr>
        <td>{{$sinhvien['ID']}}</td>
        <td>{{$sinhvien['Ten']}}</td>
        <td>{{$sinhvien['Tuoi']}}</td>
        <td>{{$sinhvien['Diem']}}</td>
    </tr>
    @endforeach

</table>