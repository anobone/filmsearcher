<!DOCTYPE html>
<html>
<head>
    <?
    include 'logic/connect_db.php';
    include 'header.php'; ?>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <style>
        table {
            width: 500px;
            margin: auto;
            border: 16px solid #ededee;
            border-collapse: separate;
            table-layout: auto;
            background: #ededee;
            text-align: center;
            font-family: sans-serif;
            border-radius: 25px;
        }
        th {
            font-weight: bold;
            padding: 5px;
            background: #ededee;
            border: 1px solid #ededee;
            text-align: center;
            font-size: 18px;
        }
        td {
            border: 5px solid #ededee;
            padding: 10px;
            background: rgba(215, 211, 211, 0.42);
            border-radius: 20px;

        }
        input{
            width: 200px;
            padding:10px;
            margin: 5px;
            border: 5px solid rgba(128, 128, 128, 0.34);
            border-radius: 10px;
        }
        .delete{
            margin-left: auto;
            margin-right: auto;
            width:500px;
            padding: 50px;
            top:50%;
        }
    </style>
</head>
<body style="background:rgba(192,192,227,0.65)">

<div class="delete">
    <form name="form-delete"  action="logic/cancel.php" enctype="multipart/form-data"  method="POST">
        <table>
            <tr>
                <th>Вы действительно хотите удалить данный элемент?</th>
            </tr>
            <tr>
                <td>
                    <input style="background:rgba(232,35,35,0.56);color:white;" type="submit" name="yes-delete" value="Да">
                    <input style="background:rgba(78,169,30,0.56);color:white;" type="submit" name="no-delete" value="Нет">

                </td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>