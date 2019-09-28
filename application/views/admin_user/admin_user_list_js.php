
<script>
    $(function () {
        $('#admin_user_list').DataTable({
            paging: true,
            scrollY: false,
            scrollX: false,
            pagingType: "first_last_numbers",
            pageLength: 10,
            lengthChange: true,
            responsive: true
        });
    });
</script>
