<h1>Student List<h1>

<table border='1'>
    <tr>
        <td>ID</td>
        <td>Name</td>
        <td>Age</td>
        <td>Mark</td>
    </tr>
    @foreach($students as $student)
    <tr>
        <td>{{$student['ID']}}</td>
        <td>{{$student['Name']}}</td>
        <td>{{$student['Age']}}</td>
        <td>{{$student['Mark']}}</td>
    </tr>
    @endforeach

</table>