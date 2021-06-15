<!DOCTYPE html>
<html lang="en">

<head>
    <title>Ajax Crud</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body class="bg-light">

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header">
                            <a href="#" class="btn btn-info" data-toggle="modal" data-target="#demoModal">Add</a>
                        </div>
                        <h5 class="card-title">AJAX CRUD</h5>
                        <table id="demoTable" class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>

                            <tbody>

                            </tbody>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Button trigger modal -->


    <!-- add Modal -->
    <div class="modal fade" id="demoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajax Add New</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frm">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name">
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

            </div>
        </div>
    </div>


    {{-- edit model --}}
    <div class="modal fade" id="editdemoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajax Add New</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editfrm">

                        <div class="form-group">
                            <input type="hidden" id='id' name="id">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="editname">
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <script>
        $(document).ready(function () {


            getAllData();

            $('#frm').submit(function (e) {
                e.preventDefault();
                // alert('f');
                let name = $('#name').val();
                let _token = $('input[name=_token]').val();

                $.ajax({
                    url: "{{ route('form_submit') }}",
                    type: "POST",
                    data: {
                        name: name,
                        _token: _token
                    },
                    success: function (res) {
                        console.log('add');
                        getAllData()


                        $('#frm')[0].reset();
                        $('#demoModal').modal('hide');


                    }
                });
            })



            $('#editfrm').submit(function (e) {
                e.preventDefault();
                let id = $('#id').val();
                let name = $('#editname').val();
                let _token = $('input[name=_token]').val();

                $.ajax({
                    url: "{{ route('updateForm') }}",
                    type: "PUT",
                    data: {
                        id: id,
                        name: name,
                        _token: _token
                    },
                    success: function (res) {

                        alert('edit');
                        $('#editfrm')[0].reset();
                        $('#editdemoModal').modal('hide');
                        getAllData();


                    }
                });
            })




        });

       

        function getAllData() {

            $.ajax({
                url: "{{ route('getAllData') }}",
                type: 'GET',
                datatype: 'josn',
                success: function (res) {
                    console.log(res);
                    var output = '';
                    var i;
                    for (i = 0; i < res.length; i++) {
                        output += "<tr id='" + res[i].id + "'><td>" + res[i].name +
                            "</td><td><button class='btn btn-primary' onclick='editdemo(" + res[
                                i].id +
                            ")'>Edit</td><td><button class='btn btn-danger' onclick='deletedemo(" +
                            res[i].id + ")'>Delete</td></tr>"
                    }

                    $('#demoTable tbody').html(output);
                }
            })
        }

        function editdemo(id) {
            $.ajax({
                url: 'edit/' + id,
                type: 'GET',
                dateType: 'json',
                success: function (res) {
                    $('#id').val(res.id);

                    $('#editname').val(res.name);
                    $('#editdemoModal').modal('toggle');
                }
            })
        }

        function deletedemo(id)
        {
            if(confirm('Are you sure you want to delete?'))
            {

                
                let _token = $('input[name=_token]').val();
                $.ajax({
                    url: 'delete/'+id,
                    type: 'DELETE',
                    data: {
                        _token: _token
                    },
                    success: function (res) {
                        console.log(res);
                        getAllData();
                    }

                })
            }
        }



    </script>

    
</body>

</html>