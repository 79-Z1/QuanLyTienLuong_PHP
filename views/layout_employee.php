<html>
<?php $this->renderSection('header_employee'); ?>

<body>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <div class="container bootstrap snippets bootdey">
        <div class="row">
            <!-- BEGIN USER PROFILE -->
            <div class="col-md-12">
                <div class="grid profile">
                    <div class="grid-header">
                        <div class="col-xs-2">
                            <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="img-circle" alt="">
                        </div>
                        <div class="col-xs-7">
                            <h3>John Doe</h3>
                            <p>@bootdey</p>
                            <p>Website Developer, Programmer</p>
                            <p>Bootdey City, NY, USA</p>
                        </div>
                        <div class="col-xs-3 text-right">
                            <p><a href="" title="Everyone can see your profile"><i class="fa fa-globe"></i> Everyone</a></p>
                        </div>
                    </div>
                    <div class="grid-body">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#profile" data-toggle="tab">Profile</a></li>
                            <li class=""><a href="#timeline" data-toggle="tab">Timeline</a></li>
                            <li class=""><a href="#photos" data-toggle="tab">Photos</a></li>
                            <li class=""><a href="#settings" data-toggle="tab">Settings</a></li>
                        </ul>
                        <div class="tab-content">
                            <?php $this->renderSection('content'); ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END USER PROFILE -->
        </div>
</body>

</html>