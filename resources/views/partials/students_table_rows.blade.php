@foreach ($students as $student)
    <tr>
        <td>{{ $student->name }}</td>
        <td>{{ $student->email }}</td>
        <td>{{ $student->gender }}</td>
        <td>{{ $student->birth_day }}</td>
        <td>{{ $student->faculty->name }}</td>
        <td>{{ $student->classroom->name }}</td>
        <td>{{ $student->section->name }}</td>
        <td>{{ $student->nationality->name }}</td>
        <td>{{ $student->parent->father_name }}</td>
        <td>{{ $student->doctor->name }}</td>
    </tr>
@endforeach