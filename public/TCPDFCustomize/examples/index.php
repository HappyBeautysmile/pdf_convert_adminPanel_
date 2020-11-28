<?php
echo '<'.'?'.'xml version="1.0" encoding="UTF-8"'.'?'.'>';
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create PDF using PHP</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<script>
<?php
    $pdfdata ='{"ID":"1","NAME":"Jone"}';
    $q = json_decode($pdfdata);
?>
function showHint(str) {
        var xmlhttp = new XMLHttpRequest();
        var pdfdata ='{"ID":"1","NAME":"Jone"}';
        var name = 'nissssck';
        // getTrumbowygContent();
        // var htmldata=  `Hello {name}` //'<p style="color: rgb(212, 212, 212); background-color: rgb(30, 30, 30); font-family: Consolas, &quot;Courier New&quot;, monospace; font-size: 14px; line-height: 19px; white-space: pre;"><span style="color: #dcdcaa;"><span>getTrumbowygContent</span></p>';
        var htmldata = $('#pdfdata').val();
        var htmldata = htmldata.replace("{name}", name);
        console.log((htmldata));
        alert(htmldata);
        $.ajax({
            type:"POST",
            url: "main.php",
            data: {"htmldata": htmldata}
            }).done(function() {
            $( this ).addClass( "done" );
        });
}
</script>
<body>


    <div class="main-block">
        <div class="header">
            Making New PDF
        </div>
        <div class="body">
            <form>
                <!-- <input type="text" name="Name" placeholder="Name" required>
                <input type="text" name="Tracking_Number" placeholder="Tracking Number" required>
                <input type="text" name="Cellphone_Number" placeholder="Cellphone Number" required>
                <input type="text" name="Packages" placeholder="Packages" required>
                <input type="text" name="Weight" placeholder="Weight" required>
                <input type="text" name="Receiver" placeholder="Receiver" required>
                <input type="text" name="TEL" placeholder="TEL" required> -->
                <!-- <input type="text" name="Name" placeholder="Name" required>
                <input type="submit" value="Make PDF"> -->
                <!-- {"name":"John","age":30,"city":"New York"} -->
                <input type="text" name="data" id='pdfdata' placeholder="data" required>
                <button type="button" onclick="showHint('sss')">Change Content</button>
                <!-- <input type="array" name="Pdfdata" value="{ID:'1',NAME:'Jone',FULLNAME:'Ekaterina',SEX:'Woman'}"> -->
                <!-- First name: <input type="text" hidden id='pdfData'> -->
            </form>
        </div>
    </div>
</body>
</html>