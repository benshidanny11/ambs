
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" />
    
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>

<body>

    <div class="martop5"></div>
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">



                <div class="row">
                    <div class="col-md-12">


                        <div class="card">
                            <div class="card-header alert-light d-flex">
                                <h5 class="card-title col-8" id="cardtitle">
                                    Inyandiko z'amateka naho biherereye
                                </h5>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Header 1</th>
                                            <th>Header 2</th>
                                            <th>Header 3</th>
                                            <th>Header 4</th>
                                            <th>Header 5</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Row:1 Cell:1</td>
                                            <td>Row:1 Cell:2</td>
                                            <td>Row:1 Cell:3</td>
                                            <td>Row:1 Cell:4</td>
                                            <td>Row:1 Cell:5</td>
                                        </tr>
                                        <tr>
                                            <td>Row:2 Cell:1</td>
                                            <td>Row:2 Cell:2</td>
                                            <td>Row:2 Cell:3</td>
                                            <td>Row:2 Cell:4</td>
                                            <td>Row:2 Cell:5</td>
                                        </tr>
                                        <tr>
                                            <td>Row:3 Cell:1</td>
                                            <td>Row:3 Cell:2</td>
                                            <td>Row:3 Cell:3</td>
                                            <td>Row:3 Cell:4</td>
                                            <td>Row:3 Cell:5</td>
                                        </tr>
                                        <tr>
                                            <td>Row:4 Cell:1</td>
                                            <td>Row:4 Cell:2</td>
                                            <td>Row:4 Cell:3</td>
                                            <td>Row:4 Cell:4</td>
                                            <td>Row:4 Cell:5</td>
                                        </tr>
                                        <tr>
                                            <td>Row:5 Cell:1</td>
                                            <td>Row:5 Cell:2</td>
                                            <td>Row:5 Cell:3</td>
                                            <td>Row:5 Cell:4</td>
                                            <td>Row:5 Cell:5</td>
                                        </tr>
                                        <tr>
                                            <td>Row:6 Cell:1</td>
                                            <td>Row:6 Cell:2</td>
                                            <td>Row:6 Cell:3</td>
                                            <td>Row:6 Cell:4</td>
                                            <td>Row:6 Cell:5</td>
                                        </tr>
                                        <tr>
                                            <td>Row:7 Cell:1</td>
                                            <td>Row:7 Cell:2</td>
                                            <td>Row:7 Cell:3</td>
                                            <td>Row:7 Cell:4</td>
                                            <td>Row:7 Cell:5</td>
                                        </tr>
                                        <tr>
                                            <td>Row:8 Cell:1</td>
                                            <td>Row:8 Cell:2</td>
                                            <td>Row:8 Cell:3</td>
                                            <td>Row:8 Cell:4</td>
                                            <td>Row:8 Cell:5</td>
                                        </tr>
                                        <tr>
                                            <td>Row:9 Cell:1</td>
                                            <td>Row:9 Cell:2</td>
                                            <td>Row:9 Cell:3</td>
                                            <td>Row:9 Cell:4</td>
                                            <td>Row:9 Cell:5</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
   

    <script type="text/javascript">
        $("#example").DataTable({
            "responsive": true,
            "autoWidth": false,
            "lengthMenu": [10]
        });
    </script>

</body>

</html>