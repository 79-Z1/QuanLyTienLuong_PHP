$('input[type=radio]').on('change', function() {
    console.log("aaaaa ")
    $(this).closest("form").submit();
});