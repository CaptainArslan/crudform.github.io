<script>
    $(document).ready(function() {
        $('.delet_confirm').click(function(e) {
            e.preventDefault();
            var id = $(this).closest("tr").find('.delete_btn').val();
            //To check does id is coming and it working
            console.log(id);
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this imaginary file!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: "POST",
                            url: "index.php",
                            data: {
                                "delete_btn_set": 1,
                                "delete_id": id,
                            },
                            success: function(response) {
                                swal("Data successfully Deleted.!", {
                                    icon: "success",
                                }).then((result) => {
                                    location.reload();
                                });
                            }
                        });
                    }
                });

        });
    });
</script>