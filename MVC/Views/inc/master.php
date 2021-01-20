<?php
    use Tamtamchik\SimpleFlash\Flash;
//    require_once './MVC/public/js/public.js'
?>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!--toggle-->
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<!--font awesome-->
<link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet"  type='text/css'>

<script src="//ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<script src="//stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<!--toggle-->
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<style>
    .loader {
        position: absolute;
        top: 0;
        left: 0;
        z-index: 100;
        width: 100%;
        height: 100%;
        background-color: rgba(192, 192, 192, 0.5);
        background-image: url("https://i.stack.imgur.com/MnyxU.gif");
        background-repeat: no-repeat;
        background-position: center;
        display: none;
    }
    .container{
        visibility: visible;
        opacity: 1;
        transition: visibility 0s, opacity 0.5s linear;
    }
</style>
<script>
    function getCookie(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for(var i = 0; i <ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) === ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) === 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }
    function getFormData(form){
        var unindexed_array = $(form).serializeArray();
        var indexed_array = {};

        $.map(unindexed_array, function(n, i){
            indexed_array[n['name']] = n['value'];
        });

        return indexed_array;
    }
    // $(document).ready(function(){
    //     $('#success-alert').hide();
    //     $('#danger-alert').hide();
    //     // $('#loader').hide();
    // })
</script>
<div class="mb-5">
<?php
       $_SESSION['success'] = null;
       $_SESSION['error'] = null;
?>
    <div class="alert alert-success" id="success-alert" style="display: none"></div>
    <div class="alert alert-danger" id="danger-alert" style="display: none"></div>
    <div class="loader" id="loader"></div>

</div>
