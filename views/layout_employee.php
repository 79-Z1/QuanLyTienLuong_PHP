<html>
<?php $this->renderSection('header_employee'); ?>

<body>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
        <div >
            <!-- BEGIN USER PROFILE -->
            <div class="col-md-12">
                <div class="grid profile">
                    <div class="grid-header">
                        <div class="">
                            <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="img-circle" alt="">
                        </div>
                        <div>
                            <h3>John Doe</h3>
                            <p>@bootdey</p>
                            <p>Website Developer, Programmer</p>
                            <p>Bootdey City, NY, USA</p>
                        </div>
                    </div>
                    <div class="grid-body">
                    <?php $this->renderSection('content'); ?>
                    </div>
                </div>
            </div>
            <!-- END USER PROFILE -->
</body>

</html>