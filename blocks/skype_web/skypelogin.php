<html>
    <head>
        <script src="//ajax.aspnetcdn.com/ajax/jQuery/jquery-1.10.2.min.js"></script>
        <script type='text/javascript'>
            $(function(){
                debugger;
                 var hash = window.location.hash;
                 var regexForState = /&state=(.+)&/g;
                 var match = regexForState.exec(hash);
                 var returnUrl = null;
                 while(match != null){
                     returnUrl = match[1];
                     break;
                 }
                 
                 if(returnUrl != null){
                     window.location = decodeURIComponent(returnUrl);
                 }
            })
        </script>
    </head>
    <body>
        <h1>Please wait while system redirects to moodle ..!</h1>
        <?php
        require_once(__DIR__.'/../../config.php');
        global $SESSION;
        $SESSION->skype_login = true;
        ?>
    </body>    
</html>


