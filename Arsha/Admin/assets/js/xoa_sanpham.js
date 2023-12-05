$(".btn_delete_sp").on("click", function(e)
{
  e.preventDefault();
//   alert("ok");
  const href  = $(this).attr("href");
  // alert (href);
  Swal.fire({
    title: "Bạn chắc chắn muốn xóa?",
    text: "Bạn sẽ không khôi phục được sản phẩm này!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!"
  }).then((result) => {
    if (result.value) {
      document.location.href = href;
    }
    
  });
})

const flashdata = $('.delete_data').data('flashdata');
// alert(flashdata)
if(flashdata)
{
  Swal.fire({  
    title: "Deleted!",
    text: "Your file has been deleted.",
    icon: "success",
    showConfirmButton: false,
    timer: 1500
  }).then(() => {
    window.location.href = "ds_danhmuc.php";
    
  });
  
}