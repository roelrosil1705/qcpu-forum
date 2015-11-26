<header class="row">
    <div class="column large-12 small-10 medium-11 text-center">
        <img class="qcpu-logo margintop10" src="<?=base_url('assets/img/banner.png');?>" alt="QCPU Logo">
    </div>
</header>

<?php
if(!$this->session->userdata('account_no')){
    ?>
    <nav class="top-bar margintop10" data-topbar role="navigation">
        <ul class="title-area">

            <li class="name">
                <h1><a href="#">Forum</a></h1>
            </li>
            <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
            <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
        </ul>
        <section class="top-bar-section">
            <!-- Right Nav Section -->
            <ul class="right">
                <li><a href="#">FAQ</a></li>
                <li><a href="#" data-reveal-id="login_modal">Sign In</a></li>
                <li class="has-dropdown hide">
                    <a href="#">Dropdown</a>
                    <ul class="dropdown">
                        <li><a href="#">link</a></li>
                        <li><a href="#">link</a></li>
                    </ul>
                </li>
            </ul>
            <!-- Left Nav Section -->
            <ul class="left">
            </ul>
        </section>
    </nav>
    <?php
}else{
    ?>
    <nav class="top-bar margintop10" data-topbar role="navigation">
        <ul class="title-area">
            <li class="name">
                <h1><a href="#">Forum</a></h1>
            </li>
            <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
            <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
        </ul>
        <section class="top-bar-section">
            <!-- Right Nav Section -->
            <ul class="right">
                <li><a href="#">Home</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">News</a></li>
                <li><a href="#">Annoucements</a></li>
                <li><a href="#">Contact Us</a></li>
                <li><a href="<?=base_url('main/logout');?>">logout</a></li>
                <li class="has-dropdown hide">
                    <a href="#">Dropdown</a>
                    <ul class="dropdown">
                        <li><a href="#">link</a></li>
                        <li><a href="#">link</a></li>
                    </ul>
                </li>
            </ul>
            <!-- Left Nav Section -->
            <ul class="left">
            </ul>
        </section>
    </nav>
    <?php
}

?>