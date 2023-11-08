<html>
<?php $this->renderSection('header_manager'); ?>
<style>
  .required::after {
    content:" *";
    color: red;
  }
</style>
<body>
    <div class="d-flex flex-column flex-lg-row h-lg-full bg-surface-secondary">
        <?php $this->renderSection('navbar_manager'); ?>
        <div class="h-screen flex-grow-1 overflow-y-lg-auto">
            <main class=" bg-surface-secondary">
                <div class="container-fluid">
                    <?php $this->renderSection('content'); ?>
                </div>
            </main>
        </div>
    </div>
    <?php $this->renderSection('footer'); ?>
</body>

</html>