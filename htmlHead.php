<head>
    <meta charset="utf-8">
    <title>MySiTe</title>
    <link rel="stylesheet" href="/Styles/MainStyles.css">
    <link rel="stylesheet" href="/Styles/AdminPanelStyles.css">
    
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript">
        var address = document.location.href;

        if(document.getElementById('a').onclick == true)
        {
            alert("The button was pressed");
            $('a').removeClass('selected');
            $("a[href='address']").addClass('selected');
        }

    </script>
</head>