
<input type="checkbox" id ="chckHead" checked/>

<script type="text/javascript">
    $('.chcktbl').click(function () {
        var length = $('.chcktbl:checked').length;      
        if (length > 3) {
            alert(length);
            $('.chcktbl:not(:checked)').attr('disabled', true);
        }
        else {
            $('.chcktbl:not(:checked)').attr('disabled', false);
        }
    });
</script>
<script type="text/javascript">
    $('#chckHead').click(function () {
        if (this.checked == false) {
            $('.chcktbl:checked').attr('checked', false);
        }
        else {
            $('.chcktbl:not(:checked)').attr('checked', true);
        }
    });
    $('#chckHead').click(function () {
    });
</script>
