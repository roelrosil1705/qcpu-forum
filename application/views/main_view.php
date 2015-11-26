<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>QCPU - Forum</title>
    <link rel="stylesheet" href="<?=base_url('assets/css/foundation.css');?>">
    <link rel="stylesheet" href="<?=base_url('assets/css/constants.css');?>">
    <link rel="stylesheet" href="<?=base_url('assets/css/style.css');?>">

    <script type="text/javascript" src="<?= base_url('assets/js/jquery-1.11.3.min.js');?>"></script>
    <script src="<?=base_url('assets/js/vendor/modernizr.js');?>"></script>
</head>
<body>
    <div class="row container">

        <?=$navigator?>

        <?=$content?>

    </div>

    <!--  modal  -->
    <div id="login_modal" class="reveal-modal tiny" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
        <h2 id="modalTitle">Login</h2>

        <form action="<?=base_url('index.php/main/login');?>" method="post">
            <label for="inp_username">Username</label>
            <input type="text" id="inp_username" name="inp_username">
            <label for="inp_password">Password</label>
            <input type="password" id="inp_password" name="inp_password">
            <button type="submit">Login</button>
        </form>
        
        <a class="close-reveal-modal" aria-label="Close">&#215;</a>
    </div>

    <script src="<?=base_url('assets/js/vendor/jquery.js');?>"></script>
    <script src="<?=base_url('assets/js/foundation.min.js');?>"></script>
    <script>
        $(document).foundation();
    </script>
</body>
</html>