<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>

<body>
    <h1 class="text-center text-danger pt-4">Çoklu Silme İşlemi</h1>
    <hr>

    <div class="row py-2">
        <div class="col-md-8 pb-2">
            <button class="btn btn-danger" id="deleteAllSelectedRecord">Seçilenleri Sil</button>
            <button class="btn btn-primary"> Yeni Ekle</button>
        </div>
        <div class="col-md-4 pb-2">
            <form action="employeee" method="get">
                <div class="input-group">
                    <select class="form-select" name="date_filter" id="">
                        <option value="">All Dates</option>
                        <option value="today">Today</option>
                    </select>
                </div>
            </form>


        </div>
    </div>

    <table class="table mt-50">
        <thead>
            <tr>
                <th><input type="checkbox" name="" id="select_all_ids"></th>
                <th scope="col">-ID</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Position</th>
                <th scope="col">Gender</th>
                <th scope="col">Email</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
                <tr id="employee_ids{{ $employee->id }}">
                    <td><input type="checkbox" name="ids" class="checkbox_ids" id=""
                            value="{{ $employee->id }}"> </td>
                    <th scope="row">{{ $employee->id }}</th>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->last_name }}</td>
                    <td>{{ $employee->position }}</td>
                    <td>{{ $employee->gender }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>

                        <button class="btn btn-info">Düzenle</button>
                        <button class="btn btn-danger">Sil</button>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.min.js"></script>
    <script>
        $(function(e) {
            $("#select_all_ids").click(function(){
                $('.checkbox_ids').prop('checked',$(this).prop('checked'));
            });

            $('#deleteAllSelectedRecord').click(function(e){
                e.preventDefault();
                var all_ids=[];
                $('input:checkbox[name=ids]:checked').each(function(){
                    all_ids.push($(this).val());
                });

                $.ajax({
                    url:"{{ route('employee.delete') }}",
                    type:"DELETE",
                    data:{
                        ids:all_ids,
                        _token:'{{ csrf_token() }}'
                    },
                    success:function(response){
                        $.each(all_ids,function(key,val){
                            $('#employee_ids'+val).remove();
                        })
                    }
                });

            });

        })


    </script>
</body>

</html>
