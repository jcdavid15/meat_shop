$(document).ready(()=>{
    $('.updateBtn').on('click', function(){
        const item_id = $(this).attr('id');
        const status_id = 4;
        Swal.fire({
            title: "Are you sure?",
            text: "This item will proceed to claim.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes!"
          }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                url: "../backend/cashier/updatePending.php",
                method: "post",
                data:{
                    item_id,
                    status_id
                },
                success: function(response){
                    if(response === 'success'){
                        window.location.reload();
                    }
                },
                error: function(){
                    alert("Connection Error")
                }
              })
            }
          });
    })

    $('.acceptBtn').on('click', function(){
        const item_id = $(this).attr('id');
        const status_id = 2;
        const prod_id = $(this).data('prod-id');
        Swal.fire({
            title: "Are you sure?",
            text: "This item will proceed to claim.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes!"
          }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                url: "../backend/cashier/updatePending.php",
                method: "post",
                data:{
                    item_id,
                    status_id,
                    prod_id
                },
                success: function(response){
                    if(response === 'success'){
                        window.location.reload();
                    }
                },
                error: function(){
                    alert("Connection Error")
                }
              })
            }
          });
    })
})