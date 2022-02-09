<html>
<head>
</head>
<body style="margin: 0px;">
<div style="width: 100%;">

    <div style="float: left; background-color: #ef0f72; width: 100%; color: #fff; padding: 5px 5px 15px 5px;">
        <h4 style="line-height: 30px;width: 100%; font-size: 17px; text-align: center; margin: 10px;">Ticket Plus</h4>
        <p style="text-align: center;">New contact form submission</p>
    </div>

    <div style="width: 100%; float: left; margin-top: 20px; padding-bottom: 100px;">
        <p> <strong>Name:</strong> {{$request->name}}</p><br>
        <p> <strong>Email:</strong> {{$request->email}}</p><br>
        <p> <strong>Subject:</strong> {{$request->subject}}</p><br>
        <p> <strong>Description:</strong> {{$request->description}}</p>
    </div>
</div>
</body>
</html>